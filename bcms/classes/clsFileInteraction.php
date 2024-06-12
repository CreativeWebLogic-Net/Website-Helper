<?php



    class clsFileInteraction{
        public $all_vars=array();
        public $var=array();
        public $cls=array();
        function __construct(){
			
			
		}

        function md_file_put_contents($file,$Contents){
			
			$current = file_get_contents($file);
            // Append a new person to the file
            $current .= $Contents;
            // Write the contents back to the file
            file_put_contents($file, $current);
		}

        function md_file($file,$Contents){
            $lines = file($file);

            // Loop through our array, show HTML source as HTML source; and line numbers too.
            foreach ($lines as $line_num => $line) {
                echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
            }

            // Using the optional flags parameter
            $trimmed = file('somefile.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }
        function streams($file){
            $existed = in_array("var", stream_get_wrappers());
            if ($existed) {
                stream_wrapper_unregister("var");
            }
            stream_wrapper_register("var", "VariableStream");
            $myvar = "";

            $fp = fopen("var://myvar", "r+");

            fwrite($fp, "line1\n");
            fwrite($fp, "line2\n");
            fwrite($fp, "line3\n");

            rewind($fp);
            while (!feof($fp)) {
                echo fgets($fp);
            }
            fclose($fp);
            var_dump($myvar);

            if ($existed) {
                stream_wrapper_restore("var");
            }
        }

        function md_filesystem($directoryPath){
            //$directoryPath = '/path/to/your/directory';

            $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($directoryPath, RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::CHILD_FIRST
            );

            foreach ($files as $fileinfo) {
                $todo = ($fileinfo->isDir() ? 'rmdir' : 'unlink');
                $todo($fileinfo->getRealPath());
            }

            rmdir($directoryPath);
        }

    }