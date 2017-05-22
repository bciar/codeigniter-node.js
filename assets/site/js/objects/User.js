/**
 * Created by Developer on 9/15/2016.
 */
var User = (function () {

    function User(userId) {
        this.id = userId;
    }

    User.prototype.mail = function (id) {
        this.id = id;
    };

    User.prototype.getUserId = function () {
        return this.id;
    };

    return User;
})();