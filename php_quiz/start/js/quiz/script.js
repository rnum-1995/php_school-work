
const API_BASE = './api/quiz';
let questions = [];
let currentIdx = 0;
let score = 0;

// 初期化：問題取得
async function init() {
  try {
    const res = await fetch(`${API_BASE}/fetch.php`);
    questions = await res.json();

    if (questions.length > 0) {
      document.getElementById('loading').classList.add('hidden');
      document.getElementById('question-area').classList.remove('hidden');
      showQuestion();
    } else {
      document.getElementById('loading').innerText = '問題がありません';
    }
  } catch (e) {
    console.error(e);
    alert('データ取得エラー');
  }
}

function showQuestion() {
  const q = questions[currentIdx];
  document.getElementById('question-text').innerText = `Q${currentIdx + 1}. ${q.question_text}`;

  const choicesArea = document.getElementById('choices-area');
  choicesArea.innerHTML = '';

  [1, 2, 3, 4].forEach(num => {
    const btn = document.createElement('button');
    btn.className = 'btn btn-outline-dark choice-btn w-100 text-start mb-2';
    btn.innerText = q[`choice${num}`];
    btn.onclick = () => checkAnswer(q.id, num);
    choicesArea.appendChild(btn);
  });

  document.getElementById('result-area').classList.add('hidden');
}

async function checkAnswer(qId, choice) {
  // ボタン無効化
  document.querySelectorAll('.choice-btn').forEach(b => b.disabled = true);

  const res = await fetch(`${API_BASE}/check.php`, {
    method: 'POST',
    body: JSON.stringify({ question_id: qId, user_choice: choice }),
    headers: { 'Content-Type': 'application/json' }
  });
  const data = await res.json();

  const resultArea = document.getElementById('result-area');
  const resultTitle = document.getElementById('result-title');
  const explanation = document.getElementById('explanation-text');

  resultArea.classList.remove('hidden', 'alert-success', 'alert-danger');
  if (data.result) {
    score++;
    resultArea.classList.add('alert-success');
    resultTitle.innerText = '正解！';
  } else {
    resultArea.classList.add('alert-danger');
    resultTitle.innerText = '不正解...';
  }
  explanation.innerText = `解説: ${data.explanation}`;

  // 次へボタンの設定
  const nextBtn = document.getElementById('next-btn');
  if (currentIdx < questions.length - 1) {
    nextBtn.onclick = () => {
      currentIdx++;
      showQuestion();
    };
    nextBtn.innerText = '次の問題へ';
  } else {
    nextBtn.onclick = showScore;
    nextBtn.innerText = '結果を見る';
  }
}

function showScore() {
  document.getElementById('question-area').classList.add('hidden');
  document.getElementById('result-area').classList.add('hidden');
  document.getElementById('score-area').classList.remove('hidden');
  document.getElementById('score-count').innerText = score;
  document.getElementById('total-count').innerText = questions.length;
}

// 自動起動
init();
