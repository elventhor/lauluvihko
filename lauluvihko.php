     <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
        <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
          <title>Lauluvihkogeneraattori</title>
        </head>
<body>

<h1>Lauluvihkogeneraattori</h1>
<h2>Luo uusi laulu</h2>
<p>Laulut löytyvät <a href="/biisit/">täältä</a>.</p>
<form action="biisinsyotto.php" method="post">
<p>
    <input name="laulun_nimi" value="Laulun nimi"/>
    <br></br>
    <textarea rows="30" cols="50" name="laulun_sanat">Laulun sanat</textarea>
    <br></br>
    <input type="submit" name="submit" value="Tallenna laulu"/>
</p>
</form>

<h2>Luo uusi lauluvihko</h2>
<p>Lauluvihkot tallentuvat <a href="/books/">tänne</a>.</p>
<?php include("songlist.php"); ?>





</body>
</html>

