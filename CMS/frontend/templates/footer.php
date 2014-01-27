            </div>
        </section>
        <footer>
            
        </footer>
        <script src="frontend/js/jquery.js"></script>
        <script src="frontend/js/letItSnow.js"></script>
        <script>
  $('header').letItSnow({
   frames:60,
   amount:100,
   form: 1,
   width: window.innerWidth,
   height: $('header').height(),
   speed: [10, 100],
   clear: true,
   css: { position: 'absolute', border: '0', top: '0', left: '0', zIndex: '0' },
   flakes: ['frontend/img/snow.png'],
   radius: [12, 2]
   });
        </script>
    </body>
</html>