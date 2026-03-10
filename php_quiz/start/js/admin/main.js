
import { checkAuth, login, logout, fetchAllQuestions, createQuestion, updateQuestion, deleteQuestion } from './api.js';
import { toggleAdminPanel, showLoginError, renderList, getFormData, setFormData, resetForm } from './view.js';

let questions = [];
let isEditMode = false;
let editingId = null;

// 要素取得（イベント設定用）
const loginBtn = document.querySelector('button[onclick="login()"]'); // HTMLのonclickに対応
const saveBtn = document.getElementById('save-btn');
const cancelBtn = document.getElementById('cancel-btn');
const logoutBtn = document.getElementById('logout-btn');

/**
 * 初期化処理
 */
export async function init() {
  // 既存のonclick属性を無効化（JSで管理するため）
  setupEventListeners();

  const isAuthenticated = await checkAuth();
  if (isAuthenticated) {
    showPanel();
  } else {
    toggleAdminPanel(false);
  }
}

/**
 * イベントリスナ設定
 */
function setupEventListeners() {
  // ログインボタン
  if (loginBtn) {
    loginBtn.onclick = null; // HTML側の設定を解除
    loginBtn.addEventListener('click', handleLogin);
  }

  // 保存ボタン
  if (saveBtn) {
    // saveBtn.onclick = null; // HTML側にonclick="saveQuestion()"がある場合
    saveBtn.addEventListener('click', handleSave);
  }

  // キャンセルボタン
  if (cancelBtn) {
    cancelBtn.addEventListener('click', handleReset);
  }

  // ログアウトボタン
  if (logoutBtn) {
    logoutBtn.addEventListener('click', handleLogout);
  }
}

/**
 * ログイン処理
 */
async function handleLogin() {
  const user = document.getElementById('username').value;
  const pass = document.getElementById('password').value;

  const isSuccess = await login(user, pass);
  if (isSuccess) {
    showLoginError('');
    showPanel();
  } else {
    showLoginError('ログインに失敗しました');
  }
}

/**
 * 管理画面表示 & データ取得
 */
async function showPanel() {
  toggleAdminPanel(true);
  try {
    questions = await fetchAllQuestions();
    renderList();
  } catch (e) {
    console.error(e);
    alert('データ取得エラー');
  }
}

/**
 * リスト描画（編集/削除ボタンのイベントハンドラも渡す）
 */
function renderList() {
  // View.renderList ではなく、インポートした renderList を使うが、
  // ここで名前が被る（関数名もrenderList）ため、View側の関数を `renderQuestionsList` などにリネームするか、
  // あるいは import 時に as で別名にする必要がある。
  // 今回は import 時に `renderList as renderQuestionsList` とするか、コード内で使い分ける。
  // しかし、このファイル内の関数 `renderList` は引数なしで、Viewの `renderList` は引数あり。
  // 分かりやすくするため、ViewのrenderListを呼び出す形にする。

  // 修正: import文で `renderList as renderViewList` とする。
  // いや、ReplacementContent内でimport文も書き換えるので、そこで対応する。

  renderList(questions, handleEditParams, handleDelete);
}

/**
 * 編集モード準備
 * @param {number} id 
 */
function handleEditParams(id) {
  const q = questions.find(item => item.id == id);
  if (!q) return;

  setFormData(q);
  isEditMode = true;
  editingId = id;
}

/**
 * 削除処理
 * @param {number} id 
 */
async function handleDelete(id) {
  if (!confirm('本当に削除しますか？')) return;

  try {
    await deleteQuestion(id);
    questions = await fetchAllQuestions(); // 再取得
    renderList();
  } catch (e) {
    alert('削除エラー');
  }
}

/**
 * 保存処理（作成or更新）
 */
async function handleSave() {
  const data = getFormData();

  try {
    if (isEditMode) {
      data.id = editingId;
      await updateQuestion(data);
      alert('更新しました');
    } else {
      await createQuestion(data);
      alert('作成しました');
    }

    handleReset();
    questions = await fetchAllQuestions(); // 再取得
    renderList();
  } catch (e) {
    console.error(e);
    alert('エラーが発生しました');
  }
}

/**
 * リセット処理
 */
function handleReset() {
  resetForm();
  isEditMode = false;
  editingId = null;
}

/**
 * ログアウト処理
 */
async function handleLogout() {
  await logout();
  location.reload();
}

// 自動起動
init();
