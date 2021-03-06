<?php

class DBInitializer {
    public $tablePortfolios;
    public $tableProjects;
    public $tableOptions;

function __construct(){
    $this->tablePortfolios = CRP_TABLE_PORTFOLIOS;
    $this->tableProjects = CRP_TABLE_PROJECTS;
    $this->tableOptions = CRP_TABLE_OPTIONS;
}

public function configure(){
    $needsConfiguration = $this->needsConfiguration();
    $needInitialization = $this->needsInitialization();

    if($needsConfiguration){
        $this->setupTables();
    }

    if($needInitialization){
    }
}

public function needsConfiguration(){
    global $wpdb;

    $tablesInDb = "Tables_in_" . $wpdb->dbname;
    $sql = "SHOW TABLES FROM `" . $wpdb->dbname . "`  WHERE `". $tablesInDb . "` LIKE '%%%s%%' OR `" . $tablesInDb . "` LIKE '%%%s%%'";

    $res = $wpdb->get_results($wpdb->prepare($sql, $this->tablePortfolios, $this->tableProjects), ARRAY_A);

    //If any table is missing needs setup
    return count($res) < 2;
}

public function needsInitialization(){
    global $wpdb;

    $tablesInDb = "Tables_in_" . $wpdb->dbname;
    $sql = "SHOW TABLES FROM `" . $wpdb->dbname . "`  WHERE `". $tablesInDb . "` LIKE '%%%s%%' OR `" . $tablesInDb . "` LIKE '%%%s%%'";
    $res = $wpdb->get_results($wpdb->prepare($sql, $this->tablePortfolios, $this->tableProjects), ARRAY_A);

    //If there are no tables yet, needs initialization
    return count($res) == 0;
}


public function checkForChanges() {
    global $wpdb;
    $table = $wpdb->get_results( $wpdb->prepare(
        "SELECT COUNT(1) FROM information_schema.tables WHERE table_schema=%s AND table_name=%s;",
        $wpdb->dbname, $this->tableProjects
    ) );
    if ( !empty( $table ) ) {
        $column = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
            $wpdb->dbname, $this->tableProjects, 'details'
        ));
        if (empty($column)) {
            $sql = "ALTER TABLE `{$this->tableProjects}` ADD `details` text";
            $wpdb->query($sql);
        }
    }
}

private function setupTables(){
    global $wpdb;

    $charset_collate = '';

    if ( ! empty( $wpdb->charset ) ) {
        $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }

    if ( ! empty( $wpdb->collate ) ) {
        $charset_collate .= " COLLATE {$wpdb->collate}";
    }

    //Create Portfolios table
    $sql = "CREATE TABLE IF NOT EXISTS {$this->tablePortfolios} (
                  `id` int NOT NULL AUTO_INCREMENT,
                  `title` varchar(255) DEFAULT NULL,
                  `corder` text DEFAULT '',
                  `options` text DEFAULT '',
                  `extoptions` text DEFAULT '',
                  PRIMARY KEY (`id`)
                )ENGINE=InnoDB $charset_collate;
        ";
    $wpdb->query( $sql );

    //Create Projects table
    $sql = "CREATE TABLE IF NOT EXISTS {$this->tableProjects} (
                  `id` int NOT NULL AUTO_INCREMENT,
                  `pid` int NOT NULL,
                  `title` varchar(255) DEFAULT NULL,
                  `description` text DEFAULT '',
                  `url` text DEFAULT '',
                  `cover` text DEFAULT '',
                  `pics` text DEFAULT '',
                  `categories` text DEFAULT '',
                  `cdate` datetime DEFAULT NULL,
                  PRIMARY KEY (`id`)
                )ENGINE=InnoDB $charset_collate;
        ";
    $wpdb->query( $sql );

}

private function initializeTables(){
    global $wpdb;

    //Insert demo portfolio
    $wpdb->insert(
        $this->tablePortfolios,
        array(
            'title' => '',
            'corder' => '',
            'options' => CRPHelper::getPortfolioDefaultOptions()
        )
    );
    $pid = $wpdb->insert_id;

    //Add demo project
    $wpdb->insert(
        $this->tableProjects,
        array(
            'pid' => $pid,
            'title' => '',
            'description' => "",
        )
    );
}
}
