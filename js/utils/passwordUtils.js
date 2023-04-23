function isValidPassword(password) {
  // min 8 letter password, with at least a symbol, upper and lower case letters and a number
  var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  return re.test(password);
}
