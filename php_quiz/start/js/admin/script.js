
const API_BASE = './api/admin';
let questions = [];
let isEditMode = false;
let editingId = null;

// 起動時にログイン状態チェック
async function checkAuth() {
  const res = await fetch(`${API_BASE}/me.php`);
  const data = await res.json();
  if (data.authenticated) {
    showAdminPanel();
    fetchQuestions(); // 一覧取得
  }
}

function showAdminPanel() {
  document.getElementById('login-section').classList.add('hidden');
  document.getElementById('admin-section').classList.remove('hidden');
  document.getElementById('logout-btn').classList.remove('hidden');
}

// ログイン処理
window.login = async function () {
  const user = document.getElementById('username').value;
  const pass = document.getElementById('password').value;

  const res = await fetch(`${API_BASE}/login.php`, {
    method: 'POST',
    body: JSON.stringify({ username: user, password: pass }),
    headers: { 'Content-Type': 'application/json' }
  });

  if (res.ok) {
    showAdminPanel();
    document.getElementById('login-error').innerText = '';
    fetchQuestions();
  } else {
    document.getElementById('login-error').innerText = 'ログインに失敗しました';
  }
};

// 問題一覧取得
async function fetchQuestions() {
  try {
    const res = await fetch(`${API_BASE}/fetch_all.php`);
    questions = await res.json();
    renderList();
  } catch (e) {
    console.error('一覧取得エラー:', e);
  }
}

// 一覧描画
function renderList() {
  const listContainer = document.getElementById('questions-list');
  if (!listContainer) return; // HTML側にコンテナがない場合

  let html = '<table class="table table-striped"><thead><tr><th>ID</th><th>問題</th><th>正解</th><th>操作</th></tr></thead><tbody>';

  questions.forEach(q => {
    html += `
            <tr>
                <td>${q.id}</td>
                <td>${q.question_text.substring(0, 20)}...</td>
                <td>${q.correct_choice}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick="window.editQuestion(${q.id})">編集</button>
                    <button class="btn btn-sm btn-danger" onclick="window.deleteQuestion(${q.id})">削除</button>
                </td>
            </tr>
        `;
  });

  html += '</tbody></table>';
  listContainer.innerHTML = html;
}

// 問題作成・更新
window.saveQuestion = async function () {
  const data = {
    question_text: document.getElementById('q-text').value,
    choice1: document.getElementById('c1').value,
    choice2: document.getElementById('c2').value,
    choice3: document.getElementById('c3').value,
    choice4: document.getElementById('c4').value,
    correct_choice: document.getElementById('correct').value,
    explanation: document.getElementById('exp').value
  };

  let url = `${API_BASE}/create.php`;
  // 更新モードならIDを追加してURL変更（今回は同じPOSTメソッドだが、update.phpを叩く）
  if (isEditMode) {
    url = `${API_BASE}/update.php`;
    data.id = editingId;
  }

  const res = await fetch(url, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  });

  if (res.ok) {
    alert(isEditMode ? '更新しました' : '作成しました');
    resetForm();
    fetchQuestions();
  } else {
    alert('エラーが発生しました');
  }
};

// 編集モードへ切り替え
window.editQuestion = function (id) {
  const q = questions.find(item => item.id == id);
  if (!q) return;

  document.getElementById('q-text').value = q.question_text;
  document.getElementById('c1').value = q.choice1;
  document.getElementById('c2').value = q.choice2;
  document.getElementById('c3').value = q.choice3;
  document.getElementById('c4').value = q.choice4;
  document.getElementById('correct').value = q.correct_choice;
  document.getElementById('exp').value = q.explanation; // DBにexplanationカラムがある前提

  isEditMode = true;
  editingId = id;

  // UI変更
  document.getElementById('form-title').innerText = `問題編集 (ID: ${id})`;
  document.getElementById('save-btn').innerText = '更新する';
  document.getElementById('cancel-btn').classList.remove('hidden');

  // フォームまでスクロール
  document.getElementById('admin-section').scrollIntoView();
};

// 削除
window.deleteQuestion = async function (id) {
  if (!confirm('本当に削除しますか？')) return;

  const res = await fetch(`${API_BASE}/delete.php`, {
    method: 'POST',
    body: JSON.stringify({ id: id }),
    headers: { 'Content-Type': 'application/json' }
  });

  if (res.ok) {
    fetchQuestions();
  } else {
    alert('削除エラー');
  }
};

// フォームリセット
window.resetForm = function () {
  document.getElementById('q-text').value = '';
  document.querySelectorAll('#admin-section input[type="text"]').forEach(i => i.value = '');
  document.getElementById('correct').value = '1';

  isEditMode = false;
  editingId = null;

  document.getElementById('form-title').innerText = '新規問題作成';
  document.getElementById('save-btn').innerText = '作成する';
  document.getElementById('cancel-btn').classList.add('hidden');
};

// ログアウト
document.getElementById('logout-btn').onclick = async () => {
  await fetch(`${API_BASE}/logout.php`);
  location.reload();
};

// 初期実行
checkAuth();
