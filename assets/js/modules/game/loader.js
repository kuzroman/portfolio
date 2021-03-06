import {hp, vent} from '../../helper';

export let LoaderV = Backbone.View.extend({
    id: 'scoreBord',
    className: 'scoreBord',
    template: hp.tmpl('tmplScoreBoard'),
    initialize: function (options) {
        this.parentV = options.pageV;
        this.render();
        this.timer = new TimerV(options);
        this.loaderSlipV = new LoaderSlipV(options);
        this.listenTo(vent, 'removeGame', this.remove);
    },
    render: function () {
        this.parentV.$el.append(this.$el.append(this.template));
    },
    show: function () {
        this.timer.render();
        this.loaderSlipV.render();
        this.$el.addClass('show');
    },
    hide: function () {
        this.$el.removeClass('show');
    }
});

let LoaderSlipV = Backbone.View.extend({
    initialize: function (options) {
        this.setElement('#loaderSlip');
        vent.game.on('changeDestroyed', this.shift, this);
        this.listenTo(vent, 'removeGame', this.remove);
    },
    render: function () {
        this.$el.css({left: 0 });
    },
    shift: function () {
        let percent = this.model.get('destroyed') / (this.model.get('NUMBER_GOALS') / 100)
            ,left = (this.$el.width() / 100) * percent
            ;
        //console.log(this.model.get('destroyed'), this.model.get('NUMBER_GOALS'), left, this.$el.width(), percent);
        this.$el.css({left: -left });
    }
});

let TimerV = Backbone.View.extend({
    initialize: function (options) {
        this.setElement('#timer');
        this.model = options.model;
        this.listenTo(vent.game, 'firstShot', this.start, this);
        this.listenTo(vent, 'removeGame', this.remove);
    },
    render: function () {
        this.$el.text(this.model.get('PERIOD') - this.model.get('timeSpend'));
    },
    start: function () {
        let id = setInterval(() => {
            //console.log('isGameFinished',this.model.isGameFinished());
            vent.game.trigger('changeTimeSpend');
            this.render();
            if (this.model.isGameFinished()) {
                //console.log('clear timer');
                clearTimeout(id);
            }
        }, 1000);
    }
});