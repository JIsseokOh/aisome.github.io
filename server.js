const express = require('express');
const cors = require('cors');
const app = express();
const port = 3000;

app.use(cors());

app.get('/api/data', (req, res) => {
  res.json({
    stats: {
      total: 100,
      positive: 65,
      negative: 35
    },
    items: [
      {
        id: 1,
        title: "샘플 제목 1",
        date: "2024-03-18",
        impactFactor: "2.5",
        sentiment: "긍정적",
        videoUrl: "https://youtube.com/watch?v=sample1"
      },
      // 더 많은 아이템 추가
    ],
    chartData: [
      { x: '1월', y: 30 },
      { x: '2월', y: 40 },
      { x: '3월', y: 35 },
      // 더 많은 데이터 포인트 추가
    ]
  });
});

app.listen(port, () => {
  console.log(`API server running at http://localhost:${port}`);
});