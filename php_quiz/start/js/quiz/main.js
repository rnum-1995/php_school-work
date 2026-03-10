import { fetchQuestions, checkAnswer } from './api.js';
import { toggleLoading, toggleQuizArea, showScore, renderQuestion, disableButtons, renderResult } from './view.js';

let questions = [];
let currentIdx = 0;
let score = 0;

/**
 * 初期化：問題取得
 */
export async function init() {
    try {
        toggleLoading(true, '問題を読み込んでいます...');
        questions = await fetchQuestions();

        if (questions.length > 0) {
            toggleLoading(false);
            toggleQuizArea(true);
            showCurrentQuestion();
        } else {
            toggleLoading(true, '問題がありません');
        }
    } catch (e) {
        console.error(e);
        alert('データ取得エラー');
        toggleLoading(true, 'エラーが発生しました');
    }
}

/**
 * 現在の問題を表示
 */
function showCurrentQuestion() {
    renderQuestion(
        questions[currentIdx],
        currentIdx,
        (userChoice) => handleAnswer(userChoice)
    );
}

/**
 * 回答時の処理
 * @param {number} userChoice
 */
async function handleAnswer(userChoice) {
    // 二重送信防止
    disableButtons();

    try {
        const q = questions[currentIdx];
        const resultData = await checkAnswer(q.id, userChoice);

        if (resultData.result) {
            score++;
        }

        const isLastQuestion = currentIdx >= questions.length - 1;

        // 結果表示 & 次へボタンの挙動設定
        renderResult(
            resultData,
            isLastQuestion,
            () => handleNext(isLastQuestion)
        );

    } catch (e) {
        console.error(e);
        alert('判定エラーが発生しました');
    }
}

/**
 * 次の問題または結果画面へ
 * @param {boolean} isLastQuestion
 */
function handleNext(isLastQuestion) {
    if (isLastQuestion) {
        showScore(score, questions.length);
    } else {
        currentIdx++;
        showCurrentQuestion();
    }
}

// 自動起動
init();
