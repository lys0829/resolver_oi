# Resolver_oi

## 使用說明:
- 配合 [scoreboard](https://github.com/lys0829/scoreboard_api) 使用

### 步驟:
1. 複製```config.example.php```到同目錄，命名為```config.php```
2. 將cms的rank data放到resolver目錄底下
3. 在cms的rank data目錄底下新增一個資料夾，命名為想要的contest名稱(此名稱將在```config.php```中設定)
4. 將```cms/contest/contest.json```放入3中新增的資料夾，並設定好比賽名稱
5. 將原cms的資料放入3中新增的資料夾
6. 修改```config.php```
7. 用bash執行```cms_to_scoreboard.php```(丟出的訊息可忽略)
8. 用bash執行```output_to_resolver.php```
9. 開啟瀏覽器，網址:```[host]/resolver/index.php/[class]/[contest]```
10. 按空白鍵便會開始resolver

### config.php設定

OPTION | 說明
---|---
$_config['sitedir'] |網站目錄名稱(***前後記得加```/```*** e.x:```/resolver/```)
$_config['class'] |class的名稱(也就是scoreboard data資料夾的名稱)
$_config['contest'] |contest的名稱(一個class可放入多個contest)
$_config['start_time'] |競賽開始時間，此時間會決定記分板的計算(UNIX time)
$_config['end_time'] |競賽結束時間，此時間會決定記分板的計算(UNIX time)
$_config['freeze_time'] |記分板凍結時間，resolver會將此時間之後的所有上傳設為pending(UNIX time)
