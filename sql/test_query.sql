USE persona_php;

			SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.direction LIKE 'Выезд'
			ORDER BY i.date_info\G;
			
			// в данные
			SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.ppr LIKE '%Бенякони (ппр)%' 
            AND i.date_info BETWEEN '2014-09-12' AND '2014-10-02'
			ORDER BY i.date_info\G;
			
			AND i.direction = 'Выезд'
			
			SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.direction = 'Выезд'
			ORDER BY i.date_info\G;
			
			
			SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info BETWEEN '2014-09-12' AND '2014-10-02'
			ORDER BY i.date_info\G;
			
			
			
			
			SELECT i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM info_fab AS i
			INNER JOIN persons AS p
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info BETWEEN '2014-10-01' AND '2014-10-10'
			ORDER BY i.date_info\G;
			
			SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info >='2014-10-01'
			ORDER BY i.date_info\G;
			
SELECT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM info_fab AS i
			INNER JOIN persons AS p
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE i.date_info BETWEEN '2014-10-01' AND '2014-10-03'
			ORDER BY p.sur\G;
			
			
			
			SELECT DISTINCT p.persons_id, p.name, p.sur, p.name_lat,
			p.sur_lat, p.birth, p.civil, p.passport, p.number_pers, p.number_auto, 
			i.date_info, i.country, i.direction, i.ppr, i.who, i.fab,
			t.sort, t.quant_sel, t.quant, t.price_sel, t.price
			FROM persons AS p
			INNER JOIN info_fab AS i
			USING (persons_id)
			INNER JOIN tmc AS t
			USING (persons_id)
			WHERE MATCH (i.fab) AGAINST ('custom tabakko')
			ORDER BY p.sur\G;
			
SELECT * FROM info_fab WHERE date_info BETWEEN '2014-10-01' AND '2014-10-03' ORDER BY date_info\G;



SELECT p.persons_id, p.name, p.sur,
                        p.birth, p.passport, i.date_info
			         FROM persons AS p
			         INNER JOIN info_fab AS i
        			 USING (persons_id)
        			 WHERE p.persons_id > 0
        			 ORDER BY p.sur\G;
					 
					 
					 SELECT * FROM persons WHERE persons_id IN '"2", "5", "8"'\G;
					 
					 SELECT * FROM persons WHERE persons_id IN ('2, 5, 8')\G;
					 
					 SELECT * FROM persons WHERE persons_id IN (1, 2, 3)\G;
					 
					 SELECT ALL * FROM persons WHERE persons_id IN (1, 2, 3)\G;
					 
					 DELETE FROM persons WHERE persons_id IN ($id_list_str)
					 DELETE FROM persons WHERE persons_id IN (9, 10);
					 SELECT * FROM persons WHERE sur_lat IN ('Pupkin', 'Zalupkin')\G;
					 
					 SELECT * FROM persons WHERE sur_lat IN ('Zalupkin', '245')
					 AND passport IN ('Zalupkin', '245')\G;
					 
					 SELECT * FROM persons WHERE sur_lat = 'Zalupkin'
					 AND passport = '245'\G;
					 
					 INSERT INTO users (users_id, login, password, sys_date)
					 VALUES (NULL, 'admin', '111', NOW());
					 
					 INSERT INTO users (users_id, login, password, sys_date)
						VALUES (NULL, 'vasya', '222', NOW());