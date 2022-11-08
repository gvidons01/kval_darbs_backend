-- Exported from QuickDBD: https://www.quickdatabasediagrams.com/
-- NOTE! If you have used non-SQL datatypes in your design, you will have to change these here.


CREATE TABLE `users` (
    `ID` bigint unsigned  NOT NULL ,
    `email` varchar(90)  NOT NULL ,
    `email_verified_at` timestamp  NOT NULL ,
    `password` varchar(255)  NOT NULL ,
    `created_at` timestamp  NOT NULL ,
    `updated_at` timestamp  NOT NULL ,
    `fname` varchar(80)  NOT NULL ,
    `lname` varchar(80)  NOT NULL ,
    `is_admin` boolean  NOT NULL ,
    `is_blocked` boolean  NOT NULL ,
    PRIMARY KEY (
        `ID`
    ),
    CONSTRAINT `uc_users_email` UNIQUE (
        `email`
    )
);

CREATE TABLE `ads` (
    `ID` bigint unsigned  NOT NULL ,
    `user_id` bigint unsigned  NOT NULL ,
    `group_id` int unsigned  NOT NULL ,
    `category_id` int unsigned  NOT NULL ,
    `subcat_id` int unsigned  NOT NULL ,
    `price` int  NOT NULL ,
    `description` text  NOT NULL ,
    `tr_type` varchar(20)  NOT NULL ,
    `created_at` timestamp  NOT NULL ,
    `updated_at` timestamp  NOT NULL ,
    `expires_at` time  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `reports` (
    `ID` bigint unsigned  NOT NULL ,
    `ad_id` bigint unsigned  NOT NULL ,
    `user_id` bigint unsigned  NOT NULL ,
    `reason` varchar(255)  NOT NULL ,
    `created_at` timestamp  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `groups` (
    `ID` int unsigned  NOT NULL ,
    `group_name` varchar(30)  NOT NULL ,
    `image` longblob  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `categories` (
    `ID` int unsigned  NOT NULL ,
    `category_name` varchar(60)  NOT NULL ,
    `group_id` int unsigned  NOT NULL ,
    `image` longblob  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `subcategories` (
    `ID` int unsigned  NOT NULL ,
    `category_id` int unsigned  NOT NULL ,
    `sub-category` varchar(60)  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `attributes` (
    `ID` int unsigned  NOT NULL ,
    `subcat_id` int unsigned  NOT NULL ,
    `attribute` varchar(40)  NOT NULL ,
    `data_type` varchar(40)  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

CREATE TABLE `locations` (
    `ad_id` bigint unsigned  NOT NULL ,
    `loc_latitude` varchar(255)  NOT NULL ,
    `loc_longitude` varchar(255)  NOT NULL
);

CREATE TABLE `equipment` (
    `ad_id` bigint unsigned  NOT NULL ,
    `AWD` boolean  NOT NULL ,
    `4WD` boolean  NOT NULL ,
    `pwr_steering` boolean  NOT NULL ,
    `AC` boolean  NOT NULL ,
    `airbag` boolean  NOT NULL ,
    `ABS` boolean  NOT NULL ,
    `ESP` boolean  NOT NULL ,
    `parking_sens` boolean  NOT NULL ,
    `cruise_ctrl` boolean  NOT NULL
);

CREATE TABLE `images` (
    `ID` int unsigned  NOT NULL ,
    `ad_id` bigint unsigned  NOT NULL ,
    `image` longblob  NOT NULL ,
    PRIMARY KEY (
        `ID`
    )
);

ALTER TABLE `ads` ADD CONSTRAINT `fk_ads_user_id` FOREIGN KEY(`user_id`)
REFERENCES `users` (`ID`);

ALTER TABLE `ads` ADD CONSTRAINT `fk_ads_group_id` FOREIGN KEY(`group_id`)
REFERENCES `groups` (`ID`);

ALTER TABLE `ads` ADD CONSTRAINT `fk_ads_category_id` FOREIGN KEY(`category_id`)
REFERENCES `categories` (`ID`);

ALTER TABLE `ads` ADD CONSTRAINT `fk_ads_subcat_id` FOREIGN KEY(`subcat_id`)
REFERENCES `subcategories` (`ID`);

ALTER TABLE `reports` ADD CONSTRAINT `fk_reports_ad_id` FOREIGN KEY(`ad_id`)
REFERENCES `ads` (`ID`);

ALTER TABLE `reports` ADD CONSTRAINT `fk_reports_user_id` FOREIGN KEY(`user_id`)
REFERENCES `users` (`ID`);

ALTER TABLE `categories` ADD CONSTRAINT `fk_categories_group_id` FOREIGN KEY(`group_id`)
REFERENCES `groups` (`ID`);

ALTER TABLE `subcategories` ADD CONSTRAINT `fk_subcategories_category_id` FOREIGN KEY(`category_id`)
REFERENCES `categories` (`ID`);

ALTER TABLE `attributes` ADD CONSTRAINT `fk_attributes_subcat_id` FOREIGN KEY(`subcat_id`)
REFERENCES `subcategories` (`ID`);

ALTER TABLE `locations` ADD CONSTRAINT `fk_locations_ad_id` FOREIGN KEY(`ad_id`)
REFERENCES `ads` (`ID`);

ALTER TABLE `equipment` ADD CONSTRAINT `fk_equipment_ad_id` FOREIGN KEY(`ad_id`)
REFERENCES `ads` (`ID`);

ALTER TABLE `images` ADD CONSTRAINT `fk_images_ad_id` FOREIGN KEY(`ad_id`)
REFERENCES `ads` (`ID`);
