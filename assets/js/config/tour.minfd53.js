/*!
 * Remark Material (http://getbootstrapadmin.com/remark)
 * Copyright 2017 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */

!function(global,factory){if("function"==typeof define&&define.amd)define("/config/tour",["Config"],factory);else if("undefined"!=typeof exports)factory(require("Config"));else{var mod={exports:{}};factory(global.Config),global.configTour=mod.exports}}(this,function(_Config){"use strict";babelHelpers.interopRequireWildcard(_Config).set("tour",{steps:[{element:"#toggleMenubar",position:"right",intro:"Offcanvas Menu <p class='content'>It is nice custom navigation for desktop users and a seek off-canvas menu for tablet and mobile users</p>"},{element:"#toggleChat",position:"left",intro:"Quick Conversations <p class='content'>This is a sidebar dialog box for user conversations list, you can even create a quick conversation with other users</p>"}],skipLabel:"<i class='md-close'></i>",doneLabel:"<i class='md-close'></i>",nextLabel:"Next <i class='md-chevron-right'></i>",prevLabel:"<i class='md-chevron-left'></i>Prev",showBullets:!1})});