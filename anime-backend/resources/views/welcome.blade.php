<div id="lottieContainer" style="width: 200px; height: 200px;"></div>

<script>
  lottie.loadAnimation({
    container: document.getElementById('lottieContainer'),
    renderer: 'svg',
    loop: true,
    autoplay: true,
    path: '{{ asset("lottie/sample.json") }}'
  });
</script>