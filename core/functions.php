<?php

function get_cards($tid){
    global $con;
    $sql = "SELECT * FROM teacher_cards WHERE t_id = '".$tid."'";
    $res = mysqli_query($con, $sql);
    $card = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $card;
}

function get_all_cards() {
    global $con;
    $sql = "SELECT * FROM teacher_cards ORDER BY id DESC";
    $result = mysqli_query($con, $sql);
    $cards = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $cards;

}

function get_teachers($sid){
    global $con;
    $sql = "SELECT * FROM student_teachers WHERE s_id = '".$sid."'";
    $res = mysqli_query($con, $sql);
    $teach = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $teach;
}

function get_students($tid){
    global $con;
    $sql = "SELECT * FROM teacher_students WHERE t_id = '".$tid."'";
    $res = mysqli_query($con, $sql);
    $stud = mysqli_fetch_all($res, MYSQLI_ASSOC);
    return $stud;
}