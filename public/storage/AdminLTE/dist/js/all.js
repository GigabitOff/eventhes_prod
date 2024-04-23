
  $(function () {
  $('.select2').select2()
  $('.select2bs4').select2({
  theme: 'bootstrap4'
})
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  $('[data-mask]').inputmask()
  $('#reservationdate').datetimepicker({
  format: 'L'
});
  $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
  $('#reservation').daterangepicker()
  $('#reservationtime').daterangepicker({
  timePicker: true,
  timePickerIncrement: 30,
  locale: {
  format: 'MM/DD/YYYY hh:mm A'
}
})
  $('#daterange-btn').daterangepicker(
{
  ranges   : {
  'Today'       : [moment(), moment()],
  'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  'This Month'  : [moment().startOf('month'), moment().endOf('month')],
  'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},
  startDate: moment().subtract(29, 'days'),
  endDate  : moment()
},
  function (start, end) {
  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
}
  )
  $('#timepicker').datetimepicker({
  format: 'LT'
})
  $('.duallistbox').bootstrapDualListbox()
  $('.my-colorpicker1').colorpicker()
  $('.my-colorpicker2').colorpicker()
  $('.my-colorpicker2').on('colorpickerChange', function(event) {
  $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
})
  $("input[data-bootstrap-switch]").each(function(){
  $(this).bootstrapSwitch('state', $(this).prop('checked'));
})
})
  document.addEventListener('DOMContentLoaded', function () {
  window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    console.log("Выбран файл:1");
})
  Dropzone.autoDiscover = false
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, {
    url: "/target-url",
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false,
    previewsContainer: "#previews",
    clickable: ".fileinput-button"
  });


  myDropzone.on("addedfile", function(file) {
   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
    console.log("Выбран файл:1");
 })

  myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
    console.log("Выбран файл:1");
})

  myDropzone.on("sending", function(file) {
  document.querySelector("#total-progress").style.opacity = "1"
  file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    console.log("Выбран файл:1");
})
  myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0"
    console.log("Выбран файл:1");
})
    document.querySelector("#actions .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function() {
      myDropzone.removeAllFiles(true)
      console.log("Выбран файл:1");
}

