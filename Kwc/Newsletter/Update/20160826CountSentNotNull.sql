ALTER TABLE `kwc_newsletter` CHANGE `count_sent` `count_sent` INT(11) NOT NULL;
UPDATE kwc_newsletter SET count_sent = (SELECT count(*) FROM `kwc_newsletter_queue_log` WHERE status='sent' and newsletter_id=kwc_newsletter.id) WHERE count_sent=0;