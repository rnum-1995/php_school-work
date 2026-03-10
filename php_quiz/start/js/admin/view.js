
/**
 * ログイン画面/管理画面の切り替え
 * @param {boolean} isLoggedIn 
 */
export function toggleAdminPanel(isLoggedIn) {
  const loginSection = document.getElementById('login-section');
  const adminSection = document.getElementById('admin-section');
  const logoutBtn = document.getElementById('logout-btn');

  if (isLoggedIn) {
    loginSection.classList.add('hidden');
    adminSection.classList.remove('hidden');
    logoutBtn.classList.remove('hidden');
  } else {
    loginSection.classList.remove('hidden');
    adminSection.classList.add('hidden');
    logoutBtn.classList.add('hidden');
  }
}

/**
 * ログインエラー表示
 * @param {string} message 
 */
export function showLoginError(message) {
  document.getElementById('login-error').innerText = message;
}

/**
 * 問題一覧テーブルの描画
 * @param {Array} questions 
 * @param {Function} onEdit (id) => void
 * @param {Function} onDelete (id) => void
 */
export function renderList(questions, onEdit, onDelete) {
  const listContainer = document.getElementById('questions-list');
  if (!listContainer) return;

  let html = '<table class="table table-striped"><thead><tr><th>ID</th><th>問題</th><th>正解</th><th>操作</th></tr></thead><tbody>';

  questions.forEach(q => {
    // XSS対策: 簡易的なエスケープが必要ならここでやるべきだが、今回は省略
    html += `
            <tr>
                <td>${q.id}</td>
                <td>${q.question_text.substring(0, 20)}...</td>
                <td>${q.correct_choice}</td>
                <td>
                    <button class="btn btn-sm btn-info edit-btn" data-id="${q.id}">編集</button>
                    <button class="btn btn-sm btn-danger delete-btn" data-id="${q.id}">削除</button>
                </td>
            </tr>
        `;
  });

  html += '</tbody></table>';
  listContainer.innerHTML = html;

  // イベントリスナ設定（innerHTML書き換え後は再設定が必要）
  listContainer.querySelectorAll('.edit-btn').forEach(btn => {
    btn.onclick = () => onEdit(btn.dataset.id);
  });
  listContainer.querySelectorAll('.delete-btn').forEach(btn => {
    btn.onclick = () => onDelete(btn.dataset.id);
  });
}

/**
 * フォーム入力値の取得
 */
export function getFormData() {
  return {
    question_text: document.getElementById('q-text').value,
    choice1: document.getElementById('c1').value,
    choice2: document.getElementById('c2').value,
    choice3: document.getElementById('c3').value,
    choice4: document.getElementById('c4').value,
    correct_choice: document.getElementById('correct').value,
    explanation: document.getElementById('exp').value
  };
}

/**
 * フォームにデータをセット（編集時）
 * @param {Object} q 
 */
export function setFormData(q) {
  document.getElementById('q-text').value = q.question_text;
  document.getElementById('c1').value = q.choice1;
  document.getElementById('c2').value = q.choice2;
  document.getElementById('c3').value = q.choice3;
  document.getElementById('c4').value = q.choice4;
  document.getElementById('correct').value = q.correct_choice;
  document.getElementById('exp').value = q.explanation;

  // UI変更
  document.getElementById('form-title').innerText = `問題編集 (ID: ${q.id})`;
  document.getElementById('save-btn').innerText = '更新する';
  document.getElementById('cancel-btn').classList.remove('hidden');

  // スクロール
  document.getElementById('admin-section').scrollIntoView({ behavior: 'smooth' });
}

/**
 * フォームのリセット
 */
export function resetForm() {
  document.getElementById('q-text').value = '';
  // input[type="text"] を全クリア
  document.querySelectorAll('#admin-section input[type="text"]').forEach(i => i.value = '');
  document.getElementById('correct').value = '1';

  // UI戻す
  document.getElementById('form-title').innerText = '新規問題作成';
  document.getElementById('save-btn').innerText = '作成する';
  document.getElementById('cancel-btn').classList.add('hidden');
}
