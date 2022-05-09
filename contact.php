<?php
  session_start();
  $mode = 'input';
  $errmessage = array();
  if( isset($_POST['back']) && $_POST['back'] ){
    // 何もしない
  } else if( isset($_POST['confirm']) && $_POST['confirm'] ){
      // 確認画面
    if( !$_POST['fullname'] ) {
        $errmessage[] = "名前を入力してください";
    } else if( mb_strlen($_POST['fullname']) > 100 ){
        $errmessage[] = "名前は100文字以内にしてください";
    }
      $_SESSION['fullname'] = htmlspecialchars($_POST['fullname'], ENT_QUOTES);

      if( !$_POST['email'] ) {
          $errmessage[] = "Eメールを入力してください";
      } else if( mb_strlen($_POST['email']) > 200 ){
          $errmessage[] = "Eメールは200文字以内にしてください";
    } else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
        $errmessage[] = "メールアドレスが不正です";
      }
      $_SESSION['email']    = htmlspecialchars($_POST['email'], ENT_QUOTES);

      if( !$_POST['message'] ){
          $errmessage[] = "お問い合わせ内容を入力してください";
      } else if( mb_strlen($_POST['message']) > 500 ){
          $errmessage[] = "お問い合わせ内容は500文字以内にしてください";
      }
      $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

      if( $errmessage ){
        $mode = 'input';
    } else {
        $mode = 'confirm';
    }
  } else if( isset($_POST['send']) && $_POST['send'] ){
    // 送信ボタンを押したとき
    $message  = "お問い合わせを受け付けました \r\n"
              . "名前: " . $_SESSION['fullname'] . "\r\n"
              . "email: " . $_SESSION['email'] . "\r\n"
              . "お問い合わせ内容:\r\n"
              . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
      mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
    mail('sayaka.kudo.0913@.com','お問い合わせありがとうございます',$message);
    $_SESSION = array();
    $mode = 'send';
  } else {
    $_SESSION['fullname'] = "";
    $_SESSION['email']    = "";
    $_SESSION['message']  = "";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="contact.css">

    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@900&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/5-1-11/css/5-1-11.css">

    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/reset.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/6-1-7/css/6-1-7.css">
    <link rel="stylesheet" type="text/css" href="https://coco-factory.jp/ugokuweb/wp-content/themes/ugokuweb/data/9-2-1/css/9-2-1.css">

    <script>
        (function(d) {
          var config = {
            kitId: 'wpf6fon',
            scriptTimeout: 3000,
            async: true
          },
          h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
        })(document);
    </script>

</head>

<body>
    <header>
        <div class="container">
            <div class="header-left">Animal Park</div>

            <div class="header-right">
                <a href="index.html">Top</a>
                <a href="aboutus.html">About Us</a>
                <a href="animals.html">Animals</a>
                <a href="access.html">Access</a>
                <a href="contact.php">Contact</a>
            </div>
        </div>
    </header>

    <div class="openbtn1"><span></span><span></span><span></span></div>
    <nav id="g-nav">
        <div id="g-nav-list"><!--ナビの数が増えた場合縦スクロールするためのdiv※不要なら削除-->
            <ul>
                <li><a href="index.html">Top</a></li>  
                <li><a href="aboutus.html">About Us</a></li>  
                <li><a href="animals.html">Animals</a></li>  
                <li><a href="access.html">Access</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <div class="container">
            <div class="top-box"></div>

            <div class="event-campain">
                <a id="contactform"></a>
                <h2 class="event-list">問い合わせフォーム</h2>

                <?php if( $mode == 'input' ){ ?>
    <!-- 入力画面 -->
    <?php
      if( $errmessage ){
        echo '<div style="color:red;">';
        echo implode('<br>', $errmessage );
        echo '</div>';
      }
    ?>

    <form action="./contact.php" method="post">
      名前    <br><input type="text"    name="fullname" value="<?php echo $_SESSION['fullname'] ?>"><br>
      Eメール <br><input type="email"   name="email"    value="<?php echo $_SESSION['email'] ?>"><br>
      お問い合わせ内容<br>
      <textarea cols="70" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea><br>
      <input class="check-botton" type="submit" name="confirm" value="確認" />
    </form>

  <?php } else if( $mode == 'confirm' ){ ?>
    <!-- 確認画面 -->
    <form action="./contact.php" method="post">
      名前    <?php echo $_SESSION['fullname'] ?><br>
      Eメール <?php echo $_SESSION['email'] ?><br>
      お問い合わせ内容<br>
      <?php echo nl2br($_SESSION['message']) ?><br>
      <input type="submit" name="back" value="戻る" />
      <input type="submit" name="send" value="送信" />
    </form>

  <?php } else { ?>
    <!-- 完了画面 -->
    送信しました。お問い合わせありがとうございました。<br>
  <?php } ?>

                <a id="snsshare"></a>
                <h2 class="event-list">SNS共有</h2>
                <ul class="follow-me">
                    <li>
                        <span class="material-symbols-outlined">
                        pets</span>
                        <a href="https://twitter.com/" class="twitter">Twitter</a>
                    <li>
                    <li>
                        <span class="material-symbols-outlined">
                        pets</span>
                        <a href="https://www.facebook.com/" class="facebook">Facebook</a>
                    <li>
                    <li>
                        <span class="material-symbols-outlined">
                        pets</span>
                        <a href="https://www.youtube.com" class="youtube">YouTube</a>
                </ul>
                

                <a id="questionlist"></a>
                <h2 class="event-list">よくある質問一覧</h2>

                <ul>
                  <li>
                    <dl>
                      <dt class="accordion_q">休園日はいつですか？</dt>
                      <dd class="accordion_a">年末年始と不定期に設けております。<br>詳しくはHPをご確認ください。</dd>
                    </dl>
                  </li>
                  <li>
                    <dl>
                      <dt class="accordion_q">夜の動物園ツアーは当日参加可能ですか？</dt>
                      <dd class="accordion_a">完全予約制です。事前予約が必要となっております。</dd>
                    </dl>
                  </li>
                  <li>
                    <dl>
                      <dt class="accordion_q">ペットを連れて入園可能ですか？</dt>
                      <dd class="accordion_a">ペット連れでの入園は不可です。</dd>
                    </dl>
                  </li>
                  <li>
                    <dl>
                      <dt class="accordion_q">駐車場はありますか？</dt>
                      <dd class="accordion_a">はい。当園から徒歩5分程度の場所にあります。</dd>
                    </dl>
                  </li>
                </ul>
                
                </div>
            </div>

        </div>
        
    </main>

    <footer>
        <div class="container">
           
            <div class="foot-wrap">
                <div class="menu-top">
                    <h3>Top</h3>
                    <ul class="foot-top">
                        <li><a href="index.html">Top</a></li>
                        <li><a href="index.html #todayevent">イベント</a></li>
                        <li><a href="index.html #todaycampain">キャンペーン</a></li>
                    </ul>
                </div>
                <div class="menu-aboutus">
                    <h3>About Us</h3>
                    <ul class="foot-aboutus">
                        <li><a href="aboutus.html #baseinformation">基本情報</a></li>
                        <li><a href="aboutus.html #goodpoints">当園の魅力</a></li>
                        <li><a href="aboutus.html #institution">当園の施設</a></li>
                    </ul>
                </div>
                <div class="menu-animals">
                    <h3>Animals</h3>
                    <ul class="foot-animals">
                        <li><a href="animals.html #riku-animals">Land Animals</a></li>
                        <li><a href="animals.html #small-animals">Small Animals</a></li>
                        <li><a href="animals.html #water-animals">Aquatic Organisms</a></li>
                    </ul>
                </div>
                <div class="menu-access">
                    <h3>Access</h3>
                    <ul class="foot-access">
                        <li><a href="access.html #address">住所</a></li>
                        <li><a href="access.html #parkmap">園内Map</a></li>
                        <li><a href="access.html #googlemap">Google Map</a></li>
                    </ul>
                </div>
                <div class="menu-contact">
                    <h3>Contact</h3>
                    <ul class="foot-contact">
                        <li><a href="contact.php #contactform">問い合わせ</a></li>
                        <li><a href="contact.php #snsshare">SNS共有</a></li>
                        <li><a href="contact.php #questionlist">よくある質問一覧</a></li>
                    </ul>
                </div>
                <small class="cmark">©️copyright 2022
                    <a href="#">Animal Park.</a>
                </small>
            </div>

        </div>
    </footer>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<!--自作のJS-->
<script src="index.js"></script>
<script src="contact.js"></script>

</body>
</html>