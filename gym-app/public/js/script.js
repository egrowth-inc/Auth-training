document.querySelectorAll('.muscle').forEach(area => {
    area.addEventListener('click', async (event) => {
        const muscleId = event.target.id;
        const infoBox = document.getElementById('info-box');

        try {
            // API からトレーニングデータを取得
            const response = await fetch(`/api/muscle/${muscleId}`);
            const data = await response.json();

            if (response.ok) {
                infoBox.innerHTML =
                    `<h3>${muscleId.toUpperCase()}</h3><p>${data.description}</p>`;
            } else {
                infoBox.innerHTML = "<p>情報が見つかりません</p>";
            }
        } catch (error) {
            console.error("エラー:", error);
            infoBox.innerHTML = "<p>データ取得に失敗しました</p>";
        }

        // 情報ボックスを表示
        infoBox.style.display = 'flex';
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const muscles = document.querySelectorAll(".muscle");

    muscles.forEach(muscle => {
        muscle.addEventListener("click", function () {
            const muscleId = this.id;

            if (muscleId) {
                window.location.href = `/training/${muscleId}`;
            } else {
                console.error("エラー: muscleId が取得できませんでした");
            }
        });
    });
});
