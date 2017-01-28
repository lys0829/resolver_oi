# Resolver_oi

## 使用說明:
- 配合 [scoreboard](https://github.com/lys0829/scoreboard_api) 使用
### 步驟:
1. 複製```config.example.php```到同目錄，命名為```config.php```
2. 將scoreboard的data放到resolver目錄底下
3. 修改```config.php```

OPTION | 說明
---|---
$_config['class'] |class的名稱(也就是scoreboard data資料夾的名稱)
$_config['contest'] |contest的名稱(一個class可放入多個contest)
$_config['start_time'] |競賽開始時間，此時間會決定記分板的計算(UNIX time)
$_config['end_time'] |競賽結束時間，此時間會決定記分板的計算(UNIX time)
$_config['freeze_time'] |記分板凍結時間，resolver會將此時間之後的所有上傳設為pending(UNIX time)

4. 用bash執行```output_to_resolver.php```
5. 開啟瀏覽器，網址:```[host]/resolver/index.php/[class]/[contest]```
6. 按空白鍵便會開始resolver