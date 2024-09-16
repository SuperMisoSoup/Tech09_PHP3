<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
include("funcs.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM avails_an_table";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Avails表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
<style>table, tr, th, td{border: 1px solid; margin:auto;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">

    <input type="text" id="test-filterInput" placeholder="検索">
      <table id="test-table">
        <thead>
          <tr>
            <th>ファイル名</th>
            <th>アップロード日</th>
            <th>種別</th>
            <th>ALID</th>
            <th>Movieタイトル</th>
            <th>エピソードタイトル</th>
            <th>シリーズID</th>
            <th>シリーズタイトル</th>
            <th>ライセンス種別</th>
            <th>SWP/SDP</th>
            <th>開始日</th>
            <th>終了日</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($values as $v){ ?>
            <tr>
              <td><?=h($v["FileName"])?></td>
              <td><?=h($v["UploadDate"])?></td>
              <td><?=h($v["WorkType"])?></td>
              <td><?=h($v["ALID"])?></td>
              <td><?=h($v["TitleInternalAlias"])?></td>
              <td><?=h($v["EpisodeTitleInternalAlias"])?></td>
              <td><?=h($v["SeriesAltID"])?></td>
              <td><?=h($v["SeriesTitleInternalAlias"])?></td>
              <td><?=h($v["LicenseType"])?></td>
              <td><?=h($v["LicenseRightsDescription"])?></td>
              <td><?=h($v["Start"])?></td>
              <td><?=h($v["End"])?></td>
              <!-- <td><a href="detail.php?id=<?=h($v["id"])?>">📝</a></td>
              <td><a href="delete.php?id=<?=h($v["id"])?>">🚮</a></td> -->
            </tr>
          <?php } ?>
        </tbody>
      </table>

  </div>
</div>
<!-- Main[End] -->

<script>
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));


  document.getElementById('test-filterInput').addEventListener('keyup', function() {
  var input = document.getElementById('test-filterInput').value.toLowerCase();
  var table = document.getElementById('test-table');
  var tr = table.getElementsByTagName('tr');

  for (var i = 1; i < tr.length; i++) {
    var td = tr[i].getElementsByTagName('td');
    var match = false;

    for (var j = 0; j < td.length; j++) {
      if (td[j].innerHTML.toLowerCase().indexOf(input) > -1) {
        match = true;
        break;
      }
    }

    if (match) {
      tr[i].style.display = '';
    } else {
      tr[i].style.display = 'none';
    }
  }
});
</script>
</body>
</html>
