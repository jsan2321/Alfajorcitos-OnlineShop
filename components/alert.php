<?php

    if(isset($success_msg)) {
        foreach($success_msg as $success) {
            echo '<script> Swal.fire("'.$success.'", "", "success"); </script>';
        }
    }

    if(isset($warning_msg)) {
        foreach($warning_msg as $warning) {
            echo '<script> Swal.fire("'.$warning.'", "", "warning"); </script>';
        }
    }

    if(isset($info_msg)) {
        foreach($info_msg as $info) {
            echo '<script> Swal.fire("'.$info.'", "", "info"); </script>';
        }
    }

    if(isset($error_msg)) {
        foreach($error_msg as $error) {
            echo '<script> Swal.fire("'.$error.'", "", "error"); </script>';
        }
    }
?>