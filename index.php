<?php
require 'IP_logger.php';
$ip_logger = new IP_Logger();
$ip_info = $ip_logger->log_ip();

$template = '403.php';

if ($ip_info['country'] == 'Canada' && $ip_info['region'] != 'ON') {
  $template = '1win-template.php';
} elseif ($ip_info['country'] == 'Brazil') {
  $template = '1win-template.php';
} elseif ($ip_info['country'] == 'United States') {
  $betus_states = ['NJ', 'NY', 'MD', 'DE', 'NV', 'MI', 'CO', 'WV', 'DC', 'CT'];
  if (in_array($ip_info['region'], $betus_states)) {
    $template = 'betus-template.php';
  } else {
    $bovada_states = ['AL', 'AK', 'AZ', 'AR', 'CA', 'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY', 'LA', 'ME', 'MA', 'MN', 'MS', 'MO', 'MT', 'NE', 'NH', 'NM', 'NC', 'ND', 'OH', 'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT', 'VT', 'VA', 'WA', 'WI', 'WY'];
    if (in_array($ip_info['region'], $bovada_states)) {
      $template = 'bovada-template.php';
    } else {
      $template = '403.php';
    }
  }
} else {
  $template = '403.php';
}
$title = '';
if($template == '403.php') {
  $title = '403';
}elseif($template == 'betus-template.php') {
  $title = 'Cazino BetUS';
}elseif($template == 'bovada-template.php') {
  $title = 'Cazino Bovada';
}elseif($template == '1win-template.php') {
  $title = 'Cazino 1win';
}

if($_GET['debug'] == 'true') {
  echo '<pre>';
  print_r($ip_info);
  echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, nofollow">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="dist/main.css">
</head>

<body>
  <?php
  require 'template-parts/' . $template;
  ?>

  <script src="dist/main.js"></script>
  <script>
  // Функция для трекинга кликов
  function trackClick(templateName) {
    fetch('track_click.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        template_name: templateName
      })
    })
    .then(response => response.json())
    .then(data => {
      console.log('Click tracked:', data);
    })
    .catch(error => {
      console.error('Error tracking click:', error);
    });
  }
  
  // Добавляем обработчики кликов на все ссылки регистрации
  document.addEventListener('DOMContentLoaded', function() {
    const registerLinks = document.querySelectorAll('.hero_btn_link');
    const currentTemplate = '<?php echo str_replace(".php", "", $template); ?>';
    
    registerLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        // Трекинг клика
        trackClick(currentTemplate);
        
        // Продолжаем переход по ссылке
        // (не предотвращаем стандартное поведение)
      });
    });
  });
  </script>
</body>

</html>