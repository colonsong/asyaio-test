# Test
## 題目一



首先不確定這是原本的room,跟property表還是特別為訂單開設的快照表，我就假設都是快照表好了，因為理論上不能去拉原本的表的用戶下完訂單後原本的room,property表都有可能被更改。
按照原本的表下的話，left join確保拉到所有訂單，where用LIKE方便不用計較28號還是29號，跟BETWEEN比效能沒差很多

```

SELECT property.name      AS property_name,
       Count(property_id) property_count
FROM   orders
       LEFT JOIN room
              ON orders.room_id = room.id
       LEFT JOIN property
              ON property.id = room.property_id
WHERE  orders.created_at LIKE '2021-02-%'
GROUP  BY property_id
ORDER  BY property_count DESC
LIMIT  10 

```

##### 建立資料表的SQL

資料庫 mysql 8 ，[資料表的SQL連結](asiayo.sql)
主要就是where on 等地方進行索引

如果要另外規劃這三張表，我會盡量的把使用者看到的畫面都寫進order表裡，如果有快照可以拍的話那可以寫重點就好金額、房間名稱、飯店名稱、打折之類的資訊，總之還是以UI要怎麼呈現那些欄位都是必須要寫到orders裡的東西。

```
SELECT orders.`property_name`,
       orders.`room_name`,
       Count(`property_id`) `property_count`
FROM   orders
WHERE  created_at LIKE '2021-02-%'
GROUP  BY property_id
ORDER  BY property_count DESC
LIMIT  10 
```

## 題目二

剛開發完發現很慢通常都是index沒設，就檢查where、join相關的INDEX有沒有設到，explan、profiling效能分析查看index有沒有跑到，像前面如果切三張表，那每次寫都要開transation寫入，也有可能發生意外LOCK TABLE的情況，所以JOIN表的數量也是考量反正規劃的原因之一，又或著同時間大量人query導致查表變慢，那就要看一些SHOW PROCESSLIST之類的觀察工具，或讓mysql紀錄一些slow query log看有沒有其他影響，其他可能也有硬體面的問題，可能效能太差，硬碟太慢之類

另外中期常有excel定期匯出，報表拉取相關的業務操作，也會增加系統的不穩定性，好的使用流程的設計也可以增加系統的穩定度，例如excel按下匯出後非同步的等待，讓queue去處理完再讓使用者去下載，query前都帶cache，產出excel後也帶cache file，這樣系統就會比較穩

減少表的大小，定期的搬移或寫入時適當的切分order的名稱也是增加穩定度的方式之一，寫job定期的把order表搬到另外一個表上，之後拉取就不會影響到目前的order

## 題目三

## Require

PHP 高精度運算支持
[php bcmath lib](https://www.php.net/manual/en/bc.setup.php)

### 設計理念

網站需求，瀏覽房間時要根據網站語系取得該幣值匯率進行轉換顯示

API為exhcnage/change，很像去國外找currency (exchange) 攤位換錢(exchange)一樣，
controller裡面有個CurrencyConventor，他要先依賴一個IExchange接口，該接口提供一個方法讓他有辦法取得匯率，然後進行轉換，轉換過程用chain方式設計，主要是可調整度高，用起來直覺。

```
$amount = CurrencyConventor::setExchange($exchange)
        ->from($request->from)
        ->to($request->to)
        ->amount($request->amount)
        ->conver();
```

## API doc
[link](api.md)

