// Ketika DOM sudah ready
$('document').ready(function () {

  // mengambil value dari input
  let qtyValue = $(this).find('.qty-input').val()
  console.log(qtyValue)

  let value = parseInt(qtyValue)

  value = isNaN(value) ? 0 : value

  // ketika tombol tambah di klik
  $('.increment-btn').click(function(e) {
    e.preventDefault()
    if (value < 10) {
      value++
      $('.qty-input').val(value)
    } 
  })

  // ketika tombol kurang di klik
  $('.decrement-btn').click(function(e) {
    e.preventDefault()
    if (value > 1) {
      value--
      $('.qty-input').val(value)
    }
  })

})