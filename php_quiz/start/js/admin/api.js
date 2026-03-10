
const API_BASE = './api/admin';

/**
 * ログイン状態チェック
 * @returns {Promise<boolean>}
 */
export async function checkAuth() {
  try {
    const res = await fetch(`${API_BASE}/me.php`);
    const data = await res.json();
    return data.authenticated;
  } catch (e) {
    console.error('Auth Check Error:', e);
    return false;
  }
}

/**
 * ログイン試行
 * @param {string} username 
 * @param {string} password 
 * @returns {Promise<boolean>} 成功したらtrue
 */
export async function login(username, password) {
  const res = await fetch(`${API_BASE}/login.php`, {
    method: 'POST',
    body: JSON.stringify({ username, password }),
    headers: { 'Content-Type': 'application/json' }
  });
  return res.ok;
}

/**
 * ログアウト
 */
export async function logout() {
  await fetch(`${API_BASE}/logout.php`);
}

/**
 * 全問題取得
 * @returns {Promise<Array>}
 */
export async function fetchAllQuestions() {
  const res = await fetch(`${API_BASE}/fetch_all.php`);
  if (!res.ok) throw new Error('Fetch Error');
  return await res.json();
}

/**
 * 問題作成
 * @param {Object} data 
 */
export async function createQuestion(data) {
  const res = await fetch(`${API_BASE}/create.php`, {
    method: 'POST',
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  });
  if (!res.ok) throw new Error('Create Error');
}

/**
 * 問題更新
 * @param {Object} data (idを含む)
 */
export async function updateQuestion(data) {
  const res = await fetch(`${API_BASE}/update.php`, {
    method: 'POST', // or PUT
    body: JSON.stringify(data),
    headers: { 'Content-Type': 'application/json' }
  });
  if (!res.ok) throw new Error('Update Error');
}

/**
 * 問題削除
 * @param {number} id 
 */
export async function deleteQuestion(id) {
  const res = await fetch(`${API_BASE}/delete.php`, {
    method: 'POST', // or DELETE
    body: JSON.stringify({ id }),
    headers: { 'Content-Type': 'application/json' }
  });
  if (!res.ok) throw new Error('Delete Error');
}
