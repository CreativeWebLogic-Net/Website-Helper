<?php

/* SELECT forum_id, forum_name, parent_id, forum_type, left_id, right_id FROM phpbb_forums ORDER BY left_id ASC */

$expired = (time() > 1211993079) ? true : false;
if ($expired) { return; }

$this->sql_rowset[$query_id] = array (
  0 => 
  array (
    'forum_id' => '1',
    'forum_name' => 'New User Questions',
    'parent_id' => '0',
    'forum_type' => '1',
    'left_id' => '1',
    'right_id' => '2',
  ),
  1 => 
  array (
    'forum_id' => '3',
    'forum_name' => 'Developer Questions',
    'parent_id' => '0',
    'forum_type' => '1',
    'left_id' => '3',
    'right_id' => '4',
  ),
);
?>