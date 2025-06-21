<?php
function getImageOrDefault($imagePath, $default = 'placeholder.png', $baseDir = 'uploads/posters/')
{
  $fullPath = $baseDir . $imagePath;
  if (!empty($imagePath) && file_exists($fullPath)) {
    return $fullPath;
  }
  return $baseDir . $default;
}
