/**
 * Created by p1027 on 12.07.2016.
 */
///////////////////////////////////////////////////////////////////////////////////////
// USER
var x = function x(z) {
    console.log(z);
    if (z > 0) {
        setImmediate((function (newZ) {
            return function () {
                x(newZ);
            };
        })(z - 1));
    }
};
var sUser = new function () {
    this.objectName = "users";

    this.login = function () {
        sNotification.hide();

        var frm = $("form:first");
        var validate = sForm.validate(frm);
        if (validate) {
            sNotification.loader();
            var u = sLink.getLinkToRoute(route["login"]);
            var data = sForm.serialize(frm) + "&localTime=" + (new Date()).getTime() / 1000;
            var successFunction = function () {
                sNotification.success();
                window.location.href = sLink.getLinkToRoute(route["home"]);
            };
            sAjax.request(u, data, successFunction);
        } else {
            sNotification.validation();
        }
    };
    this.logout = function () {
        var u = sLink.getLinkToRoute(route['logout']);
        var data = undefined;
        var successCallback = function () {
            sNotification.success();
            window.location.href = sLink.getLinkToRoute(route["home"]);
        };
        sAjax.request(u, data, successCallback);
    };

    this.forgotMyPassword = function () {

        sNotification.hide();

        var frm = $("form:first");
        var validate = sForm.validate(frm);
        if (validate) {

            sNotification.loader();

            var u = sLink.getLinkToRoute(route["forgotmypassword"]);
            var d = sForm.serialize(frm);
            /**
             *
             * @param {{msg: string}} ret
             */
            var successCallback = function (ret) {
                sNotification.success(null, ret.msg);
                setTimeout(function () {
                    window.location = sLink.getLinkToRoute(route["login"]);
                }, 1000);
            };
            sAjax.request(u, d, successCallback)
        } else {
            sNotification.validation();
        }
    };

    this.resetMyPassword = function () {

        sNotification.hide();

        var frm = $("form:first");
        var validate = sForm.validate(frm);
        if (validate) {

            sNotification.loader();

            var u = sLink.getLinkToRoute(route["resetmypassword"]);
            var d = sForm.serialize(frm);
            var successCallback = function () {
                sNotification.success(null, ret.msg);
            };
            sAjax.request(u, d, successCallback);
        } else {
            sNotification.validation();
        }
    };

    this.saveMyDetail = function () {

        sNotification.hide();

        var frm = $("form:first");
        var validate = sForm.validate(frm);
        if ($("#Password").val() != $("#Password2").val()) {
            validate = false;
        }
        if (validate) {
            sNotification.loader();
            var u = sLink.getLinkToRoute(route["mydetail"]);
            var d = sForm.serialize(frm);
            sAjax.request(u, d)
        } else {
            sNotification.validation();
        }
    };

    this.save = function () {
        sCommon.save(
            this.objectName,
            function () {
                sNotification.success();
                window.location = sLink.getLinkToRoute(route["users"]);
            }
        );
    };

    this.erase = function () {
        sCommon.erase(this.objectName);
    };

    this.sendNewPassword = function () {

        sNotification.hide();

        var frm = $("form:first");
        var validate = sForm.validate(frm);
        if (validate) {
            sNotification.loader();
            var u = sLink.getLinkToRoute(route["users_send"]);
            var d = sForm.serialize(frm);
            sAjax.request(u, d);
        } else {
            sNotification.validation();
        }
    };
};