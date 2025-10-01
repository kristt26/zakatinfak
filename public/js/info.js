angular
  .module("apps", [
    "infoctrl",
    "helper.service",
    "info.service",
    "auth.service",
    "naif.base64",
    "message.service",
    "ngLocale",
    "datatables",
    "cur.$mask",
    // 'ngAnimate',
    // 'ngSanitize',
    // 'ui.router',
    "ui.select2",
  ])

  // .run(['uiSelect2Config', function(uiSelect2Config) {
  //     uiSelect2Config.placeholder = "Placeholder text";
  //     // $scope.$on('place', function(evt, data){
  //     // })
  // }])
  .controller("indexController", indexController)
  .directive("emaudio", emaudio)
  .filter("toDouble", toDouble)
  .filter("toDate", toDate)
  .filter("waktuLalu", waktuLalu)
  .filter("unique", unique);
// .directive('dynamic', ['$compile', function ($compile) {
//     return {
//       restrict: 'A',
//       replace: true,
//       link: function (scope, ele, attrs) {
//         scope.$watch(attrs.dynamic, function (html) {
//           ele.html(html);
//           $compile(ele.contents())(scope);
//         });
//       }
//     };
//   }])

function indexController($scope, helperServices, dashboardServices) {
  $scope.titleHeader = "Laboratorium Assets";
  $scope.header = "";
  $scope.breadcrumb = "";
  $scope.title;
  $scope.warning = 0;
  $scope.$on("SendUp", function (evt, data) {
    $scope.header = data;
    $scope.header = data;
    $scope.breadcrumb = data;
    $scope.title = data;
    $.LoadingOverlay("hide");
  });
  dashboardServices.getCart().then((res) => {
    // console.log(res);
    $scope.keranjang = res;
  });
  $scope.$on("setKerangjang", function (evt, data) {
    var item = $scope.keranjang.cart.find(
      (item) => item.id_variant == data.id_variant
    );
    if (item) item.qty += data.qty;
    else $scope.keranjang.cart.push(data);
    // console.log($scope.keranjang);
  });

  $scope.logout = () => {
    localStorage.removeItem("user");
    document.location.href = helperServices.url + "auth/logout";
  };
}

function emaudio() {
  var template =
    '<div class="audio-container"><div class="album-container"><img ng-src="{{album}}" /></div><span class="audio-controls"><div class="audio-row">{{artist}} - {{title}}</div><div class="audio-row"><span class="audio-play" ng-click="play()">{{isplaying ? "&#9632;" : "&#9658;"}}</span><div class="progress" ng-mousedown="setTime($event)" ng-mouseup="reset()"><div class="bar" data-ng-style="barstyle"></div></div><span class="audio-time">{{duration}}</span></div></span></div>';
  return {
    restrict: "E",
    template: template,
    replace: true,
    scope: {
      album: "@",
      url: "@",
      artist: "@",
      title: "@",
    },
    link: function ($scope, $element) {
      //Width of progress bar element
      $scope.timelineWidth =
        $element[0].querySelectorAll(".progress")[0].offsetWidth;
      $scope.audio = new Audio();
      $scope.audio.type = "audio/mpeg";
      $scope.audio.src = $scope.url;
      $scope.duration = "0:00";
      $scope.barstyle = { width: "0%" };
      $scope.isplaying = false;
      $scope.play = function () {
        if ($scope.isplaying) {
          $scope.audio.pause();
          $scope.isplaying = false;
        } else {
          $scope.audio.play();
          $scope.isplaying = true;
        }
      };

      $scope.setTime = function ($event) {
        // remove listener on audio
        $scope.audio.removeEventListener("timeupdate", timeupdate, true);

        var position = $event.clientX - $event.target.offsetLeft;

        $scope.time = (position / $scope.timelineWidth) * 100;
        $scope.audio.currentTime = ($scope.time * $scope.audio.duration) / 100;

        $scope.barstyle.width = $scope.time + "%";
      };

      $scope.reset = function () {
        $scope.audio.addEventListener("timeupdate", timeupdate);
      };

      $scope.audio.addEventListener("timeupdate", timeupdate);

      function timeupdate() {
        var sec_num = $scope.audio.currentTime;
        var minutes = Math.floor(sec_num / 60);
        var seconds = sec_num - minutes * 60;
        if (minutes < 10) {
          minutes = "0" + minutes;
        }
        minutes += "";
        if (seconds < 10) {
          seconds = "0" + seconds;
        }
        seconds += "";

        var time = minutes + ":" + seconds.substring(0, 2);
        $scope.duration = time;

        $scope.barstyle.width =
          ($scope.audio.currentTime / $scope.audio.duration) * 100 + "%";
        $scope.$apply();
      }
    },
  };
}

function unique() {
  return function (items, key) {
    if (!items || !key) return items;
    const uniqueItems = [];
    const keys = new Set();
    items.forEach((item) => {
      if (!keys.has(item[key])) {
        keys.add(item[key]);
        uniqueItems.push(item);
      }
    });
    return uniqueItems;
  };
}

function toDouble() {
  return function (input) {
    var value = parseFloat(input);
    return isNaN(value) ? null : value;
  };
}

function toDate() {
  return function (input) {
    var value = new Date(input);
    return isNaN(value) ? null : value;
  };
}

function waktuLalu() {
  return function (input) {
    if (!input) return "";

    // Konversi '2025-06-17 00:21:43' -> '2025-06-17T00:21:43'
    const waktu = moment(input.replace(" ", "T"));

    if (!waktu.isValid()) return "-";

    const now = moment();
    const diffInHours = now.diff(waktu, "hours");

    // Jika lebih dari 48 jam, tampilkan dalam format yyyy-MM-dd
    if (diffInHours > 48) {
      return waktu.format("YYYY-MM-DD");
    }

    return waktu.fromNow(); // "3 jam yang lalu", "2 hari yang lalu"
  };
}
