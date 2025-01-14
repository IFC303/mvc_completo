<?php

class Paginator
{
    private $_db;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;

    public function __construct($db, $query)
    {
        $this->_db = $db;
        $this->_query = $query;

        $this->_db->query($query);
        $this->_total = $this->_db->rowCount();
    }

    public function getData($limit = 4, $page = 1)
    {
        $this->_limit   = $limit;
        $this->_page    = $page;

        if ($this->_limit == 'all') {
            $query      = $this->_query;
        } else {
            $query      = $this->_query . " LIMIT " . (($this->_page - 1) * $this->_limit) . ", $this->_limit";
        }

        $this->_db->query($query);
        $results = $this->_db->registros();

        $result         = new stdClass();
        $result->page   = $this->_page;
        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
        $result->data   = $results;

        return $result;
    }

    public function createLinks($links, $list_class)
    {
        if ($this->_limit == 'all') {
            return '';
        }

        $last       = ceil($this->_total / $this->_limit);

        $start      = (($this->_page - $links) > 0) ? $this->_page - $links : 1;
        $end        = (($this->_page + $links) < $last) ? $this->_page + $links : $last;

        $html       = '<ul class="' . $list_class . '">';

        $class      = ($this->_page == 1) ? "page-item disabled" : "page-item";
        $html       .= '<li class="' . $class . '"><a class="page-link" href="./' . $this->_page - 1 . '">&laquo;</a></li>';

        if ($start > 1) {
            $html   .= '<li><a href="./1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class  = ($this->_page == $i) ? "page-item active" : "page-item";
            $html   .= '<li class="' . $class . '"><a class="page-link" href="./' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html   .= '<li class="page-item disabled"><span>...</span></li>';
            $html   .= '<li><a class="page-link" href="./' . $last . '">' . $last . '</a></li>';
        }

        $class      = ($this->_page == $last) ? "page-item disabled" : "page-item";
        $html       .= '<li class="' . $class . '"><a class="page-link" href="./' . $this->_page + 1 . '">&raquo;</a></li>';

        $html       .= '</ul>';

        return $html;
    }
}
