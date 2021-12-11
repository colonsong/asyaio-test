# API文件 


---

### API 共用錯誤碼

| err_code | 說明              |
| ---- | :---------------- |
| 406  | ValidationException          |
| 404  | InvalidRateException          |


## API

### 
```plaintext
GET /api/v1/exchange/change
```

| 欄位       | 型態    | 必要參數 | 說明                                 |
| ---------- | ------- | -------- | :----------------------------------- |
| from         | string | V        | 轉換前幣值 ex TWD           |
| to | integer | V        | 轉換後幣值 ex JPY                    |
| amount       | float  | V        | 轉換前幣值金額 |
| is_floor   | boolean  |         | default: true 四捨五入小數第二位 |
| is_format   | boolean  |         | default: true  千分位格式化 |

Response example

```json
{
    success: true,
        params: {
            from: "TWD",
            to: "USD"
        },
    rate: 0.03281,
    err_msg: "",
    err_code: 0,
    result: "3.28"
}
```

Response 欄位說明

| 欄位       | 型態    |  說明                                 |
| ---------- | ------- | :----------------------------------- |
| success         | boolean |   true 成功, false 失敗          |
| params | object |    input params                    |
| params.from | string |   轉換前幣值                    |
| params.to | string |   轉換後幣值                   |
| rate       | float  |    當下取得匯率 |
| err_msg   | string  |   錯誤訊息 |
| err_code   | number  |   錯誤碼 |

