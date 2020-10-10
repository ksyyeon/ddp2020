<?php 
    $link = mysqli_connect("localhost", "admin", "admin", "employees");
    $filtered = array(
        'emp_no' => mysqli_real_escape_string($link, $_POST['emp_no']),
        'birth_date' => mysqli_real_escape_string($link, $_POST['birth_date']),
        'first_name' => mysqli_real_escape_string($link, $_POST['first_name']),
        'last_name' => mysqli_real_escape_string($link, $_POST['last_name']),
        'gender' => mysqli_real_escape_string($link, $_POST['gender']),
        'hire_date' => mysqli_real_escape_string($link, $_POST['hire_date'])
    );

    $check_query="select * from employees where emp_no='{$filtered['emp_no']}'";
    $check_result = mysqli_query($link, $check_query);
    if(mysqli_num_rows($check_result) > 0) {
        echo '이미 존재하는 직원 번호가 있습니다. <a href = "emp_insert.php">돌아가기</a>';
    } else {
        $query="
        insert into employees (
            emp_no, 
            birth_date, 
            first_name, 
            last_name, 
            gender, 
            hire_date
        ) values (
            '{$filtered['emp_no']}',
            '{$filtered['birth_date']}',
            '{$filtered['first_name']}',
            '{$filtered['last_name']}',
            '{$filtered['gender']}',
            '{$filtered['hire_date']}'
        )
    ";
        //print_r($query);
        $result = mysqli_query($link, $query);
        if($result == false){
            echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
            error_log(mysqli_error($link));
        } else {
            header('Location: emp_select.php');
        }
    }
?>