CREATE TABLE constituencies (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    constituency VARCHAR(50)
);

CREATE TABLE wards (
    constituency_id INT(11) PRIMARY KEY,
    wards VARCHAR (50)
);

-- Westlands	Kitisuru · Parklands/Highridge · Kangemi · Karura · Mountain View
-- Dagoretti North	Kilimani · Kawangware · Gatina · Kileleshwa · Kabiro ·
-- Dagoretti South	Mutu-ini, Karen, · Ngand'o · Riruta satellite · Uthiru/Ruthimitu · Waithaka ·
-- Langata	Karen · Nairobi West · Nyayo Highrise · South C ·
-- Kibra	Laini Saba · Lindi · Makina · Woodley-Kenyatta Golf Course · Sarang'ombe ·
-- Roysambu	Githurai · Kahawa West · Zimmermann · Roysambu · Kahawa
-- Kasarani	Clay City · Mwiki · Kasarani · Njiru Shopping Centre · Ruai · Kakamega
-- Ruaraka	Babadogo · Utalii · Mathare North · Lucky Summer · Korogocho ·
-- Embakasi South	Imara Daima · Kwa Njenga · Kwa Reuben · Pipeline · Kware ·
-- Embakasi North	Kariobangi North · Dandora Area I · Dandora Area II · Dandora Area III · Dandora Area IV ·
-- Embakasi Central	Kayole North · Kayole NorthCentral · Kayole South · Komarock · Chokaa  · Matopeni/ Spring Valley ·
-- Embakasi East	Upper Savanna · Lower Savanna · Embakasi Constituency · Utawala · Mihang'o ·
-- Embakasi West	Umoja I · Umoja II · Mowlem · Kariobangi South ·
-- Makadara	Maringo/ Hamza · Viwandani · Harambee · Makongeni ·
-- Kamukunji	Pumwani · Eastleigh North · Eastleigh South · Airbase · California ·
-- Starehe	Nairobi Central · Ngara · Pangani · Ziwani/ Kariokor · Landimawe · Nairobi South ·
-- Mathare	Hospital · Mabatini · Huruma · Ngei · Mlango Kubwa · Kiamaiko ·

INSERT INTO constituencies (`constituencies`) VALUES
('Westlands'),
('Dagoretti North'),
('Dagoretti South'),
('Langata'),
('Kibra'),
('Roysambu'),
('Kasarani'),
('Ruaraka'),
('Embakasi South'),
('Embakasi North'),
('Embakasi Central'),
('Embakasi East'),
('Embakasi West'),
('Makadara'),
('Kamukunji'),
('Starehe'),
('Mathare')

INSERT INTO wards (`constituency_id`, `ward`) VALUES
('1', 'Kitisuru'),
('1', 'Parklands/Highridge'),
('1', 'Kangemi'),
('1', 'Karura'),
('1', 'Mountain View'),

('2', 'Kilimani'),
('2', 'Kawangware'),
('2', 'Gatina'),
('2', 'Kileleshwa'),
('2', 'Kabiro'),

('3', 'Mutu-ini'),
('3', 'Karen'),
('3', 'Ngando'),
('3', 'Riruta satellite'),
('3', 'Uthiru/Ruthimitu'),
('3', 'Waithaka'),

('4', 'Karen'),
('4', 'Nairobi West'),
('4', 'Nyayo Highrise'),
('4', 'South C'),

('5', 'Laini Saba'),
('5', 'Lindi'),
('5', 'Makina'),
('5', 'Woodley-Kenyatta Golf Course'),
('5', 'Sarang-ombe'),

('6', 'Githurai'),
('6', 'Kahawa West'),
('6', 'Zimmermann'),
('6', 'Roysambu'),
('6', 'Kahawa'),

('7', 'Clay City'),
('7', 'Mwiki'),
('7', 'Kasarani'),
('7', 'Njiru Shopping Centre'),
('7', 'Ruai'),
('7', 'Kakamega'),

('8', 'Babadogo'),
('8', 'Utalii'),
('8', 'Mathare North'),
('8', 'Lucky Summer'),
('8', 'Korogocho'),

('9', 'Imara Daima'),
('9', 'Kwa Njenga'),
('9', 'Kwa Reuben'),
('9', 'Pipeline'),
('9', 'Kware'),

('10', 'Kariobangi North'),
('10', 'Dandora Area I'),
('10', 'Dandora Area II'),
('10', 'Dandora Area III'),
('10', 'Dandora Area IV'),

('11', 'Kayole North'),
('11', 'Kayole NorthCentral'),
('11', 'Kayole South'),
('11', 'Komarock'),
('11', 'Chokaa'),
('11', ' Matopeni/Spring Valley'),

('12', 'Upper Savanna'),
('12', 'Lower Savanna'),
('12', 'Embakasi Constituency'),
('12', 'Utawala'),
('12', 'Mihango'),

('13', 'Umoja I'),
('13', 'Umoja II'),
('13', 'Mowlem'),
('13', ' Kariobangi South'),

('14', 'Maringo/Hamza'),
('14', 'Viwandani'),
('14', 'Harambee'),
('14', 'Makongeni'),

('15', 'Pumwani'),
('15', 'Eastleigh North'),
('15', 'Eastleigh South'),
('15', 'Airbase'),
('15', 'California'),

('16', 'Nairobi Central'),
('16', 'Ngara'),
('16', 'Pangani'),
('16', 'Ziwani/ Kariokor'),
('16', 'Landimawe'),

('17', 'Hospital'),
('17', 'Mabatini'),
('17', 'Huruma'),
('17', 'Ngei'),
('17', 'Mlango Kubwa'),
('17', 'Kiamaiko')
