<?php
//processes song.txt's to .tex and .pdf
//

//TODO regexp check
$name = $_GET['songs'];
$cover = $_GET['pics'];
$pdfsavedir = 'books_pdf';

$songbookname = preg_replace('/[^A-Za-z0-9_\-]/', '_', $_GET['bookname']);  //regexp rips off the useless stuff.
$songbooktitle = preg_replace('/[^A-Za-zäöüåÄÖÅÜ0-9_\ -\p{L}]/', '_', $_GET['bookname']); 

if (is_array($name)) {

//This tells which folder and which name are used to save songbook.
$filename = 'books/' . $songbookname . '.tex' ;

//read file and writes it contents to another file.
function readAndWrite($readfilename, $writefilename) {

$myfile = fopen($readfilename, "r") or die("Unable to open file!");
$fileContents = PHP_EOL . fread($myfile,filesize($readfilename));

fclose($myfile);
writetofile($writefilename, $fileContents);
}

//Kirjoittaa ensimmäisen parametrin nimiseen tiedostoon toisen parametrin sisällön.
function writetofile($writefile, $fileContents){
echo $fileContents;
$ret = file_put_contents($writefile, $fileContents, FILE_APPEND | LOCK_EX);
 if($ret === false) {
        die('There was an error writing this file');
    }
    else {
        echo "$ret tavun kokoinen laulu tallennettu onnistuneesti.";
    }
}

//$songbookbegin  is the stuff that's needed before the chapters for generating latex document.
$songbookbegin = 'structure/begin.tex';
readAndWrite($songbookbegin, $filename);

//Adds frontpage picture
$covername = '\includegraphics[width=\textwidth,height=\textheight,keepaspectratio]{' . 'frontpage/' . $cover[0] . '}';
writetofile($filename, $covername);


//Adds stuff after frontpage picture
$after = 'structure/after_frontpage.tex';
readAndWrite($after, $filename);


//Creates title page
//readAndWrite('structure/titlepage.tex', $filename);

//Writes name of songbook.
//writetofile($filename,'\title{' . $songbooktitle . '}' . PHP_EOL  .'\maketitle');


//Kirjoitetaan laulukirjaan valitut laulut.
foreach ($name as $song) {

$readfile = 'biisit/' . $song;
echo $readfile;
readAndWrite($readfile, $filename); 

}

//Laulukirjan loppuun vaaditut tekstit.
$songbookend = 'structure/end.tex';
readAndWrite($songbookend, $filename);

//Generates .pdf
$generate = 'pdflatex -output-directory books_pdf/ ' . $filename;
echo "GENERATE:" . $generate;
echo exec($generate);
echo exec($generate);

//removes unnecessary files
/*$firstpart = substr($filename, 0, -4);
echo exec(rm $firstpart . '.aux');
echo exec(rm $firstpart . '.toc');
echo exec(rm $firstpart . '.out');
*/

//shell_exec("/usr/bin/pdflatex -output-directory /pdfs --interaction batchmode $filename");
$pdfname = substr('books_pdf/' . $songbookname . '.pdf');
//DEBUG echo "PDF-NIMI:" . $pdfname;
if(file_exists($pdfname)){
echo '<a href="' . $pdfname . '">' . $pdfname . '</a>';
//readfile($pdfname);
//header( "refresh:5;url=$pdfname" );
}
else{
echo "pdf-generointi ei onnistunut!";
echo '<a href="' . $pdfname . '">' . $pdfname . '</a>';
}

//echo "Homma toimii ja laulu raikaa!";

}

else{
echo "ei ole lista!";
}


?>

