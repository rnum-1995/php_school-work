
const API_BASE = './api/quiz';

/**
 * 問題一覧を取得する
 * @returns {Promise<Array>}
 */
export async function fetchQuestions() {
  const res = await fetch(`${API_BASE}/fetch.php`);
  if (!res.ok) {
    throw new Error(`API Error: ${res.status}`);
  }
  return await res.json();
}

/**
 * 回答を送信して正誤判定を行う
 * @param {number} questionId 
 * @param {number} userChoice 
 * @returns {Promise<Object>} { result: boolean, explanation: string }
 */
export async function checkAnswer(questionId, userChoice) {
  const res = await fetch(`${API_BASE}/check.php`, {
    method: 'POST',
    body: JSON.stringify({
      question_id: questionId,
      user_choice: userChoice
    }),
    headers: { 'Content-Type': 'application/json' }
  });

  if (!res.ok) {
    throw new Error(`API Error: ${res.status}`);
  }
  return await res.json();
}
