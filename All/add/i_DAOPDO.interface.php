<?php
interface i_DAOPDO{
    public function fetchAll($sql);
    public function fetchRow($sql);
    public function fetchOne($sql);
    public function query($sql);
}