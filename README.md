# Tech09_PHP3

# ①課題番号-プロダクト名

VideoCentral(AmazonPrimeビデオのCMS)用Availsシート管理DB 改
- 業務で使う用
- AmazonPrimeビデオで提供する作品のライセンス情報を管理するDB
- 作品ごとに登録された最新のライセンスを参照できる

## ③DEMO

https://docomo-tech-tkn.sakura.ne.jp/09_PHP3/index.php

## ④作ったアプリケーション用のIDまたはPasswordがある場合

- なし
- 入力サンプルファイルで動作確認可能です
  --※キー：AQ列のALID
  --新規登録：DBにALIDが存在しない & G列EntryType＝Full Extract
  --更新　　：DBにALIDが存在する & G列EntryType＝Full Extract
  --削除　　：DBにALIDが存在する & G列EntryType＝Full Delete
  
## ⑤工夫した点・こだわった点

- エクセルで実現できないようにするために、エクセル自体を入力して内容を管理する仕組みにした(PHPSpreadSheet)
- 複数のエクセルフォーマットに対応するためDBカラム名と一致する列のデータのみをINSERTするようにした
- 表参照で検索機能を実装した
- 以下の条件をエクセルで指定した場合にそれぞれ実行できるようにした
- 　新規登録：DBにIDが存在しない場合
- 　更新　　：DBにIDが存在する場合
- 　削除　　：DBにIDが存在してエクセルでDeleteを指定した場合
 
## ⑥難しかった点・次回トライしたいこと(又は機能)

- エクセルの書式が日付のデータの場合、UNIXタイムスタンプで計算してdate形式に変換することでようやく実現できた
- 空白行がある場合など例外にも対応できるようにしたい
