<?php


interface DataManager
{

    function getConnection();

    function GetData($sql);

    function ExecuteSQL($sql);
}