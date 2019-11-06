<?php
    function writeTextInFile($fileDirectory,$name, $password)
    {

                $file       = fopen($fileDirectory, "r");
                $fileText   = fread($file, filesize($fileDirectory));

                $file       = fopen($fileDirectory, "w");

                fwrite($file, $fileText."$name=>$password;");
                fclose($file);

    }

    function serchTextBetweenSymbols($wayToFile, $searchName)
    {
        $file     = fopen($wayToFile, "r");

        if(filesize($wayToFile) > 0)
        {
            $fileText = fread($file, filesize($wayToFile));
        }
        else
        {
            $fileText = '';
        }

        $searchSym1 = '=>';
        $searchSym2 = ';';

        $searchPos1 = 0;


        while($searchPos1 < strlen($fileText))
        {

            $searchPos2 = strpos($fileText, $searchSym1, $searchPos1);
            $strLength  = $searchPos2 - $searchPos1;
            $strSlice   = substr($fileText, $searchPos1, $strLength);

            if(trim($strSlice) !== '' && trim($strSlice) === trim($searchName))
            {
                return "$searchName is taken<br/>";
            }

            $searchPos1 = strpos($fileText, $searchSym2, $searchPos2) + 1;

        }

        fclose($file);
        return "";
    }



?>