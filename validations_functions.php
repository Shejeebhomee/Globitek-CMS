<?php

  // is_blank('abcd')
  function is_blank($value='') {
    // TODO
    return (empty($value));
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    // TODO
    if(strlen($value) >= $options['min'] && strlen($value) <= $options['max'] ){

      return true;
    } else {
      return false;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    // TODO
    if (strpos($value, '@') !== false) {
    return true;
}
else { 
  return false;
  }
}

?>
