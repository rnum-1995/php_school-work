/**
 * ローディング表示の切り替え
 * @param {boolean} isShow 
 * @param {string} message 
 */
export function toggleLoading(isShow, message = '読み込み中...') {
  const loading = document.getElementById('loading');
  if (isShow) {
    loading.classList.remove('hidden');
    loading.innerText = message;
  } else {
    loading.classList.add('hidden');
  }
}

/**
 * クイズ画面の表示・非表示
 * @param {boolean} isShow 
 */
export function toggleQuizArea(isShow) {
  const area = document.getElementById('question-area');
  if (isShow) {
    area.classList.remove('hidden');
  } else {
    area.classList.add('hidden');
  }
}

/**
 * 結果画面（スコア）の表示
 * @param {number} score 
 * @param {number} total 
 */
export function showScore(score, total) {
  document.getElementById('question-area').classList.add('hidden');
  document.getElementById('result-area').classList.add('hidden');

  const scoreArea = document.getElementById('score-area');
  scoreArea.classList.remove('hidden');

  document.getElementById('score-count').innerText = score;
  document.getElementById('total-count').innerText = total;
}

/**
 * 1問分のデータを画面に描画する
 * @param {Object} question DBから取得した問題オブジェクト
 * @param {number} currentIndex 0始まりの現在のインデックス
 * @param {Function} onAnswer 回答ボタンが押されたときのコールバック (choiceNumber) => void
 */
export function renderQuestion(question, currentIndex, onAnswer) {
  // 問題文
  document.getElementById('question-text').innerText = `Q${currentIndex + 1}. ${question.question_text}`;

  // 選択肢エリアのクリア
  const choicesArea = document.getElementById('choices-area');
  choicesArea.innerHTML = '';

  // 選択肢ボタン生成 (1~4)
  [1, 2, 3, 4].forEach(num => {
    const btn = document.createElement('button');
    btn.className = 'btn btn-outline-dark choice-btn w-100 text-start mb-2'; // bootstrap class
    btn.innerText = question[`choice${num}`];
    btn.onclick = () => onAnswer(num);
    choicesArea.appendChild(btn);
  });

  // 前回の判定結果を隠す
  document.getElementById('result-area').classList.add('hidden');
}

/**
 * 全回答ボタンを無効化する（二重送信防止）
 */
export function disableButtons() {
  document.querySelectorAll('.choice-btn').forEach(b => b.disabled = true);
}

/**
 * 判定結果を表示する
 * @param {Object} data APIからのレスポンス { result: boolean, explanation: string }
 * @param {boolean} isLastQuestion 最終問題かどうか
 * @param {Function} onNext 次へボタンが押されたときのコールバック
 */
export function renderResult(data, isLastQuestion, onNext) {
  const resultArea = document.getElementById('result-area');
  const resultTitle = document.getElementById('result-title');
  const explanation = document.getElementById('explanation-text');

  // クラスのリセット
  resultArea.classList.remove('hidden', 'alert-success', 'alert-danger');

  // 正誤に応じた表示
  if (data.result) {
    resultArea.classList.add('alert-success');
    resultTitle.innerText = '正解！';
  } else {
    resultArea.classList.add('alert-danger');
    resultTitle.innerText = '不正解...';
  }

  explanation.innerText = `解説: ${data.explanation}`;

  // 次へボタンの設定
  const nextBtn = document.getElementById('next-btn');
  nextBtn.innerText = isLastQuestion ? '結果を見る' : '次の問題へ';

  // clickイベントは上書きされるので、シンプルに代入でOK
  nextBtn.onclick = onNext;
}
