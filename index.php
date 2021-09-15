<?php
	if (isset($_COOKIE['id'])) {
		$id = $_COOKIE['id'];
	}
	define ('SITE_ROOT', realpath(dirname(__FILE__)));
	if (isset($_FILES['upload'])) {
		$errors = array();
		$file_name = $_FILES['upload']['name'];
		$file_size = $_FILES['upload']['size'];
		$file_tmp = $_FILES['upload']['tmp_name'];
		$file_type = $_FILES['upload']['type'];
		// $file_ext = strtolower(end(explode('.', $_FILES['upload']['name'])));

		if ($file_size > 104857600) {
			$errors[] = 'Размер файла не может быть больше 100Мб';
		}

		if (empty($errors) == true) {
			if (!isset($id)) {
				echo "<script>alert('Время сессии закончилось, пожалуйста, авторизируйтесь заново')</script>"; ;
			} else {
				if (!file_exists(SITE_ROOT."/files/".$id)) {
					mkdir(SITE_ROOT."/files/".$id);
				}
				move_uploaded_file($file_tmp, SITE_ROOT."/files/".$id."/".$file_name);
				header("Location: /#my-work-section__title");
			}
		} else {
			echo "<script>alert('".$errors."')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<!-- <meta name="viewport" content="width=device-width"> -->
	<!-- <meta name="viewport" content="width=1920"> -->
	<meta name="viewport" content="initial-scale=1, width=device-width">
	<title>ВГГ - Личный кабинет гимназиста</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
</head>

<body>

	<noscript class="bad-browser">
		<p class="bad-browser__text">Для работы сайта необходим JavaScript. Попробуйте включить JavaScript в настройках. Если не получится, то обновите браузер</p>
	</noscript>

	<!-- <?php
		// if($_COOKIE['surname'] != '' && $_COOKIE['name'] != ''):
	?>
		<script>
			
		</script>

	<?php // endif;?> -->

	<div class="authorization" onclick="closeLoginPanel()" style="display: none">

		<div class="authorization-block" onclick="mayCloseAuthorization = false">

			<h5 class="authorization-block__title">Вход в личный кабинет</h5>

			<p class="authorization-form-elem__text incorrect-user" style="text-align: center; width: 100%; min-width: 100%; padding-right: 25px; font-size: 25px; color: #CC1347; display: none">Неверный логин или пароль</p>

			<form action="php/authorization.php" class="authorization-form" method="post">

				<div class="authorization-form-elem">
					<input type="text" class="authorization-form-elem__input" name="login" id="login">
					<p class="authorization-form-elem__text">Логин</p>
				</div>
				<div class="authorization-form-elem">
					<input type="password" class="authorization-form-elem__input" name="password" id="password">
					<p class="authorization-form-elem__text">Пароль</p>
				</div>

				<div class="authorization-form__memory">
					<input type="checkbox" class="authorization-form__checkbox" value="1" name="memory">
					<p class="authorization-form__text">Запомнить меня</p>
				</div>

				<button class="authorization-block__button" type='submit' onclick="successLogin()"></button>
			</form>

		</div>

	</div>

	<?php
	if (isset($_COOKIE['bad'])) {
		if ( $_COOKIE['bad'] == "1") {
			echo "<script>
				let authorizationPanel1 = document.querySelector('.authorization');
				authorizationPanel1.style.display = 'block';
				let incorrectUser1 = document.querySelector('.incorrect-user');
				incorrectUser1.style.display = 'block';
				</script>";
		} else {
			echo "<script>
				let incorrectUser1 = document.querySelector('.incorrect-user');
				incorrectUser1.style.display = 'none';
				</script>";
		}
	}
	?>




	<!-- <div class="reminder" onclick="closeReminder()" style="display: none">

		<div class="reminder-block" onclick="mayCloseReminder = false">
			<h5 class="reminder-block__title">Напоминалка</h5>
			<p class="reminder-block__text">Несданных работ: <span class="reminder-block__counter">2</span>!</p>
			<a href="#my-work-section__title"><div class="reminder-block__button" onclick="closeReminder()"></div></a>
		</div>
		
	</div> -->

	<nav class="nav">

		<div class="logo-wrapper">
			<a href="https://vhg.ru/" class="logo"></a>
			<a href="https://vhg.ru/"><div class="logo-wrapper__text">Личный кабинет <br>гимназиста <br>КОГОАУ ВГГ</div></a>
		</div>

		<div class="nav__line"></div>

		<div class="nav-block-wrapper">

			<div class="nav-block">

				<div class="nav-elem" onclick="wasInAccountCheck()">
					<div class="nav-elem-icon">
						<img src="img/svg/personal_account.svg" alt="" class="nav-elem-icon__img" id="nav-elem__personal-account">
					</div>
					<p class="nav-elem__text">Вход в личный <br>кабинет</p>
				</div>

				<!-- <div class="nav-elem" onclick="personalAccountDisabled()"> -->
				<div class="nav-elem" onclick="alert('Календарь пока что не работает')">
					<!-- <a href="#calendar-section__title"> -->
						<div class="nav-elem-icon">
							<img src="img/svg/calendar.svg" alt="" class="nav-elem-icon__img" id="nav-elem__calendar">
						</div>
						<p class="nav-elem__text">Календарь <br>дедлайнов</p>
					<!-- </a> -->
				</div>

				<!-- <div class="nav-elem" onclick="personalAccountDisabled()"> -->
				<div class="nav-elem" onclick="wasInAccountCheck()">
					<!-- <a href="#project-materials-section__title"> -->
					<a href="#my-work-section__title">
						<div class="nav-elem-icon">
							<img src="img/svg/file_exchange.svg" alt="" class="nav-elem-icon__img" id="nav-elem__file-exchange">
						</div>
						<p class="nav-elem__text">Мои <br>работы</p>
					</a>
				</div>

			</div>

		</div>

		

		<div class="nav-arrow" onclick="navArrowClick()">
			<img src="img/svg/Group 5.svg" alt="" class="nav-arrow__img">
		</div>

	</nav>

	<header class="header">

		<div class="container">

			<img src="img/main.jpg" alt="" class="header__img">
			<h1 class="header__title">Вятская гуманитарная гимназия</h1>
			<h2 class="header__desc">Личный кабинет гимназиста</h2>
			<img src="img/svg/Group_2.svg" alt="" class="header__arrow">

			<?php
				if(isset($_COOKIE['surname']) && $_COOKIE['surname'] != ''):
			?>
			<form action="php/exit.php" method="post">
				<input type="submit" value="Выход" class="header__exit-button">
			</form>
			<?php
				endif;
			?>

		</div>

	</header>
	
	<section class="calendar-section">

		<div class="container">


			<h2 class="calendar-section__title" name="calendar-section__title"><a name="calendar-section__title"></a>Календарь дедлайнов</h2>

			<div class="main-calendar">

				<div class="calendar">

					<div class="calendar-button">
						<div class="calendar-button__text">Март 2020г.</div>
						<img class="calendar-button__right" src="img/svg/Group 27.svg">
						<img class="calendar-button__left" src="img/svg/Group 28.svg">
					</div>

					<div class="calendar__weekdays">
						<div class="calendar__weekdays__day">пн</div>
						<div class="calendar__weekdays__day">вт</div>
						<div class="calendar__weekdays__day">ср</div>
						<div class="calendar__weekdays__day">чт</div>
						<div class="calendar__weekdays__day">пт</div>
						<div class="calendar__weekdays__day">сб</div>
						<div class="calendar__weekdays__day">вс</div>
					</div>

					<div class="calendar__days-block">
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
						<div class="calendar__days-block__row">
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
							<div class="calendar__days-block__row__day"></div>
						</div>
					</div>

				</div>

				<div class="nearest-term">
					<h3 class="nearest-term__title">Ближайшие сроки </h3>
					<ul class="nearest-term__list">
						<li class="nearest-term__list__elem">Lorem ipsum.</li>
						<li class="nearest-term__list__elem">Lorem ipsum.</li>
						<li class="nearest-term__list__elem">Lorem ipsum.</li>
						<li class="nearest-term__list__elem">Lorem ipsum.</li>
						<li class="nearest-term__list__elem">Lorem ipsum.</li>
						<li class="nearest-term__list__elem"></li>
						<li class="nearest-term__list__elem"></li>
						<li class="nearest-term__list__elem"></li>
						<li class="nearest-term__list__elem"></li>
						<li class="nearest-term__list__elem"></li>
					</ul>
				</div>
			</div>
		</div>

		<div class="calendar-section__line"></div>

	</section>
	
	<section class="project-materials-section" style="display: none">

		<div class="container">

			<h2 class="project-materials-section__title"><a name="project-materials-section__title"></a>Проектные  материалы</h2>

			<div class="chose-material">

				<p class="chose-material__text">Выберите предмет</p>

				<select class="chose-material__select">
					<option value="" class="chose-material__select__option">lorem1</option>
					<option value="" class="chose-material__select__option">lorem2</option>
					<option value="" class="chose-material__select__option">lorem3</option>
					<option value="" class="chose-material__select__option">lorem4</option>
					<option value="" class="chose-material__select__option">lorem5</option>
					<option value="" class="chose-material__select__option">lorem6</option>
					<option value="" class="chose-material__select__option">lorem7</option>
				</select>

			</div>

			<p class="project-materials-section__links">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum magni inventore ut officiis cumque a voluptate sit, explicabo ad deserunt iste minima fugit quibusdam culpa vel sequi minus ea mollitia aliquid laboriosam architecto accusantium aperiam quos delectus ex. Facilis praesentium, qui ipsum neque nihil vitae sed quod, aliquid deleniti tempore iure sit repellat ut asperiores.</p>

		</div>

	</section>

	<section class="personal-account" style="display: none">

		<div class="container">

			<h2 class="personal-account__title">Личный кабинет гимназиста/ки</h2>

			<div class="personal-account__info-block">
				<div class="personal-account__photo-wrapper">
					<img src="img/svg/personal_account.svg" alt="" class="personal-account__standart-photo"><img src="" alt="" class="personal-account__pupil-photo">
				</div>
				<p class="personal-account__fio">Фамилия Имя</p>
				<p class="personal-account__class">Класс</p>
				<p class="personal-account__teacher">Предмет</p>
			</div>

			<div class="personal-account__statistic-block">
				<div class="statistic-panel">
					<div class="statistic-panel__circle"></div>
					<p class="statistic-panel__text">Выполнено: ??%</p>
				</div>
				<p class="personal-account__statistic-text">Статистика отправленных работ учеником</p>
				<a href="#my-work-section__title" class="personal-account__button">Мои работы</a>
			</div>
			
		</div> <!-- style="display: none" -->
		
	</section>

	<section class="my-work-section" style="display: none">

		<div class="container">

			<div class="my-work-section__title"><a name="my-work-section__title"></a>Мои работы</div>

			<div class="work-table">

				<form action="php/delete-file.php" method="post">
					<input type="text" class="work-table-elem__delete-button" name="delete-text" id="delete-text">
					<input type="submit" name="delete-button" class="work-table-elem__delete-button" id="delete-button">
				</form>

				<script>
					let deleteButton = document.querySelector('#delete-button');
					let deleteText = document.querySelector('#delete-text');

					function startDelete(file_name) {
						if (!file_name) {
							return;
						}
						deleteText.value = file_name;
						deleteButton.click();
					}
				</script>

				<?php
					if (file_exists(SITE_ROOT."/files/".$id)) {
						$files_array = scandir(SITE_ROOT."/files/".$id);
						if (!$files_array || count($files_array) <= 2) {
							echo "<p style='text-align: center;'>Файлов не обнаружено</p>";
						} else {
							foreach ($files_array as $value) {
								if ($value != '.' && $value != '..' && $value != '') {
									echo '<div class="work-table-elem">
										<p class="work-table-elem__name">'.$value.'</p>
										<a class="work-table-elem__download-button" href="'."files/".$id."/".$value.'" download="'.$value.'" title="Скачать '.$value.'"></a>
										<div class="work-table-elem__delete-file" onclick="startDelete(\''.addslashes($value).'\')">x</div>
									  </div>';
								}
								
							};							
						}
					} else {
						echo "<p style='text-align: center;'>Файлов не обнаружено</p>";
					}
				?>
					
				</div>
			</div>

			<form enctype="multipart/form-data" method="post">

				<label for="file-choose" class="my-work-section__upload-button"></label>
				<input class="my-work-section__upload-button-input" type="file" value="" id="file-choose"
				name="upload" multiple="multiple">

				<label for="file-upload" class="my-work-section__upload-button2"></label>
				<input class="my-work-section__upload-button-input" type="submit" value="Отправить" id="file-upload"
				name="upload2">

			</form>

		</div>

	</section>

	<section class="teacher-section" style="display: none">

		<div class="container">

			<h2 class="teacher-section__title">Личный кабинет педагога</h2>

			<div class="teacher-section__info-block">

				<p class="teacher-section__fio">Фамилия Имя</p>
				<p class="teacher-section__subject">Предмет</p>

			</div>

			<h3 class="teacher-section__pupil-works-title">Работы учеников</h3>

			<div class="teacher-section__pupil-works-content">

				<?php
					if (isset($_COOKIE['type']) && $_COOKIE['type'] >= 1) {
						$subjects = explode(", ", strtolower($_COOKIE['subjects']));
						$type = $_COOKIE['type']; // 1: teacher; 2: admin

						$mysql = new mysqli('your_domain', 'your_username', 'your_password', 'name_of_database');
						
						$result = $mysql->query("SELECT * FROM `users` WHERE `type` = '0'");

						$counter = 0;

						while ($user = $result->fetch_assoc()) {
    						$user_subjects = explode(", ", strtolower($user['subjects']));
    						$good = false;
    						foreach ($user_subjects as $value) {
    							if (in_array($value, $subjects)) {
    								$good = true;
    								break;
    							}
    						}
    						if ($good) {
    							$student_id = $user['id'];
    							if (file_exists(SITE_ROOT."/files/".$student_id)) {
									$files_array = scandir(SITE_ROOT."/files/".$student_id);
								} else {
									$files_array = array();
								}
    							if (!$user['name']) {$user['name'] = 'Имя';}
    							if (!$user['surname']) {$user['surname'] = 'Фамилия';}
    							if (!$user['class']) {$user['class'] = 'Класс';}
    							if (!$user['project']) {$user['project'] = 'ИмяПроекта';}
    							if (!$user['subjects']) {$user['name'] = 'Предмет';}
    							echo '<div class="work-content-block">
    						<div class="work-content-elem">
						<p class="work-content-elem__title">
							<span class="work-content-elem__title--surname">'.$user['surname'].'</span> 
							<span class="work-content-elem__title--name">'.$user['name'].'</span> 
							<span class="work-content-elem__title--class">'.$user['class'].'</span>
						</p>
						<p class="work-content-elem__files">Файлов: <span class="work-content-elem__files--counter">'.max(0, count($files_array) - 2).'</span></p>
						<div class="work-content-elem__open-button" onclick="toggleDataBlock('.$counter.')">&#62;</div>
					</div>

					<div class="data-block" style="display: none">
						<p class="data-block__project">Проект: <span class="data-block__project--name">'.$user['project'].'</span></p>
						<p class="data-block__subjects">'.$user['subjects'].'</p>
						<div class="pupils-files-block">';
								$counter += 1;
								if ($files_array && count($files_array) > 2) {
									foreach ($files_array as $value) {
										if ($value == '.' || $value == '..' || $value == '') {
											continue;
										}
										echo '<div class="work-table-elem pupil-files-block-elem">
									<p class="work-table-elem__name">'.$value.'</p>
									<a class="work-table-elem__download-button" href="'."files/".$student_id."/".$value.'" download="'.$value.'" title="Скачать '.$value.'"></a>
								</div>';
									}
								}
								echo '</div></div></div>';	
    						}
						}
					}

					
				?>
				
			</div>

			<script>
				let pupilWorksContent = document.querySelector('.teacher-section__pupil-works-content');
				let openDataBlocks = new Map()

				for (let i = 0; i < pupilWorksContent.children.length; i += 2) {
					let fullBlock = pupilWorksContent.children[i];
					fullBlock.style.backgroundColor = "#fbfbfb";
				}

				
				function toggleDataBlock(id) {
					if (pupilWorksContent.children.length <= id) {
						console.log("Teachers table: Error with id " + String(id));
						return;
					}
					let dataBlock = pupilWorksContent.children[id].querySelector('.data-block');
					let openButton = pupilWorksContent.children[id].querySelector('.work-content-elem__open-button');
					let fullBlock = pupilWorksContent.children[id];
					if (openDataBlocks.has(id)) {
						if (openDataBlocks.get(id)) {
							dataBlock.style.display = "none";
							openButton.style.paddingLeft = "25px";
							openButton.style.right = "10px";
							openButton.style.transform = "translate(0, -50%) rotate(90deg)";
						} else {
							dataBlock.style.display = "block";
							openButton.style.paddingLeft = "15px";
							openButton.style.right = "15px";
							openButton.style.transform = "translate(0, -50%) rotate(-90deg)";
						}
						openDataBlocks.set(id, !openDataBlocks.get(id));
					} else {
						dataBlock.style.display = "block";
						openButton.style.paddingLeft = "15px";
						openButton.style.right = "15px";
						openButton.style.transform = "translate(0, -50%) rotate(-90deg)";
						openDataBlocks.set(id, true);
					}
				}
			</script>

		</div>

	</section>

	<script src="js/main.js"></script>

	<?php
		if(isset($_COOKIE['surname']) && $_COOKIE['surname'] != ''):
	?>
		<script>
			if (<?php echo $_COOKIE['type'] ?>) {
				isPupil = false;
			} else {
				isPupil = true;
			}
			personalAccountEnabled(isPupil);
			<?php if (isset($_COOKIE['surname'])) {
				echo "fi = \"{$_COOKIE['surname']} {$_COOKIE['name']}\"";
			} ?>;
			<?php if (isset($_COOKIE['class'])) {
				echo "school_class = \"{$_COOKIE['class']}\"";
			} ?>;
			<?php if (isset($_COOKIE['subjects'])) {
				echo "subjects = \"{$_COOKIE['subjects']}\""; 
			} ?>;

			if (isPupil) {
				if (fi) {
					pupilFio.textContent = fi;
				} 
				if (school_class) {
					pupilClass.textContent = "Класс: " +  school_class;
				}
				if (subjects) {
					pupilSubjects.textContent = subjects;
				}
			} else {
				if (fi) {
					teacherFio.textContent = fi;
				}
				if (subjects) {
					teacherSubjects.textContent = subjects;
				}
			}

		</script>

	<?php
		endif;
	?>

	
</body>

</html>