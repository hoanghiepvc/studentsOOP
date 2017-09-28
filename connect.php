<?php
class DB_connect
{
	private $_conn;
	function connect() {
		if(!$this->_conn) {
			$this->_conn = mysqli_connect('127.0.0.1','root','','qlsv_db') or die ('loi ket noi');
			mysqli_query($this->_conn, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
				
		}
	}
	function dis_connect(){
		if($this->_conn) {
			mysqli_close($this->_conn);
		}
	}
	function get_all_students(){
	$this-> connect();
	$sql = "select * from tb_sinhvien";
	$query = mysqli_query($this->_conn,$sql);
	$result = array();
	if ($query){
		while($row = mysqli_fetch_assoc($query)) {
			$result[]= $row;	
	}
}
return $result;
}
function get_student($student_id){
	$this-> connect();
	$sql = "select * from tb_sinhvien where sv_id = {$student_id}";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($this->_conn, $sql);
     
    // Mảng chứa kết quả
    $result = array();
     
    // Nếu có kết quả thì đưa vào biến $result
    if (mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
     
    // Trả kết quả về
    return $result;
}
function add_student($student_name, $student_sex, $student_birthday){
	$this->connect();
	$student_name = addslashes($student_name);
   $student_sex = addslashes($student_sex);
   $student_birthday = addslashes($student_birthday);
     
    // Câu truy vấn thêm
    $sql = "
            INSERT INTO tb_sinhvien(sv_name, sv_sex, sv_birthday) VALUES
            ('$student_name','$student_sex','$student_birthday')
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($this->_conn, $sql);
     
    return $query;
}
function edit_student($student_id, $student_name, $student_sex, $student_birthday)
{

    // Hàm kết nối
    $this->connect();
     
    // Chống SQL Injection
    $student_name       = addslashes($student_name);
    $student_sex        = addslashes($student_sex);
    $student_birthday   = addslashes($student_birthday);
     
    // Câu truy sửa
    $sql = "
            UPDATE tb_sinhvien SET
            sv_name = '$student_name',
            sv_sex = '$student_sex',
            sv_birthday = '$student_birthday'
            WHERE sv_id = $student_id
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($this->_conn, $sql);
     
    return $query;
}
function delete_student($student_id)
{
 
    // Hàm kết nối
    $this->connect();
     
    // Câu truy sửa
    $sql = "
            DELETE FROM tb_sinhvien
            WHERE sv_id = $student_id
    ";
     
    // Thực hiện câu truy vấn
    $query = mysqli_query($this->_conn, $sql);
     
    return $query;
}
}	
?>