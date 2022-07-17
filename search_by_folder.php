<?php
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        include 'db_connect.php';

        $ftype = $_POST['fdr'];

        $usr = $_SESSION['login_type'];
	    if ($usr == 1) {
		    $files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_admin = 1) AND f.ftype='.$files.' order by date(f.date_updated) desc");
	    } elseif ($usr == 2) {
		    $files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_dean = 1) AND f.ftype='.$files.' order by date(f.date_updated) desc");
	    } else {
		    $files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  (f.is_public = 1 OR f.is_hod = 1) AND f.ftype='.$files.' order by date(f.date_updated) desc");
	    }

        while ($row = $files->fetch_assoc()) {
            $name = explode(' ||', $row['name']);
            $name = isset($name[1]) ? $name[0] . " (" . $name[1] . ")." . $row['file_type'] : $name[0] . "." . $row['file_type'];
            $img_arr = array('png', 'jpg', 'jpeg', 'gif', 'psd', 'tif');
            $doc_arr = array('doc', 'docx');
            $pdf_arr = array('pdf', 'ps', 'eps', 'prn');
            $icon = 'fa-file';
            if (in_array(strtolower($row['file_type']), $img_arr))
                $icon = 'fa-image';
            if (in_array(strtolower($row['file_type']), $doc_arr))
                $icon = 'fa-file-word';
            if (in_array(strtolower($row['file_type']), $pdf_arr))
                $icon = 'fa-file-pdf';
            if (in_array(strtolower($row['file_type']), ['xlsx', 'xls', 'xlsm', 'xlsb', 'xltm', 'xlt', 'xla', 'xlr']))
                $icon = 'fa-file-excel';
            if (in_array(strtolower($row['file_type']), ['zip', 'rar', 'tar']))
                $icon = 'fa-file-archive';
        }
    }

?>
