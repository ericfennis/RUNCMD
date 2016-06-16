! function(o) {
    function t(e) {
        if (s[e]) return s[e].exports;
        var i = s[e] = { exports: {}, id: e, loaded: !1 };
        return o[e].call(i.exports, i, i.exports, t), i.loaded = !0, i.exports
    }
    var s = {};
    return t.m = o, t.c = s, t.p = "", t(0)
}([function(o, t, s) {
    var e, i;
    e = s(1), i = s(4), o.exports = e || {}, o.exports.__esModule && (o.exports = o.exports["default"]), i && (("function" == typeof o.exports ? o.exports.options || (o.exports.options = {}) : o.exports).template = i)
}, function(o, t) {
    "use strict";
    o.exports = {
        link: { label: "Calendar" },
        props: ["link"],
        data: function() {
            return { posts: [] }
        },
        created: function() { this.$http.get("api/calendar/event", { filter: { limit: 1e3 } }).then(function(o) { this.$set("posts", o.data.posts) }) },
        ready: function() { this.link = "@calendar" },
        filters: {
            link: function(o) {
                return "@calendar/id?id=" + o.id
            }
        }
    }, window.Links.components["link-calendar"] = o.exports
}, , , function(o, t) { o.exports = "<div class=uk-form-row> <label for=form-link-calendar class=uk-form-label>{{ 'View' | trans }}</label> <div class=uk-form-controls> <select id=form-link-calendar class=uk-width-1-1 v-model=link> <option value=@calendar>{{ 'Events View' | trans }}</option> <optgroup :label=\"'Events' | trans\"> <option v-for=\"p in posts\" :value=\"p | link\">{{ p.title }}</option> </optgroup> </select> </div> </div>" }]);
