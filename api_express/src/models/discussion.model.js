const Joi = require('@hapi/joi');
const mongoose = require('mongoose');

const Messages = new mongoose.Schema({
    id_messages: {
        type: Number,
        required: true,
    },
    id_senders: {
        type: Number,
        required: true,
    },
    id_receiver: {
        type: Number,
        required: true,
    }
})

const Discussion = mongoose.model('Discussion', new mongoose.Schema({
    id: {
        type: Number,
    },
    room: {
        type: String,
        required: true,
        minlength: 5,
        maxlength: 100,
        unique: true
    },
    messages: [Messages]
}, { timestamps: true }));

function Validate (discussion) {
    const schema = Joi.object({
        id: Joi.number().integer(),
        room: Joi.string()
            .min(5)
            .max(100)
            .required(),
    });
    return schema.validate(discussion);
}

function ValidateMessage (message) {
    const schema = Joi.object({
        id_messages: Joi.number().integer(),
        id_senders: Joi.number().integer(),
        id_receiver: Joi.number().integer(),

    });
    return schema.validate(message);
}

module.exports = {
    Discussion,
    Validate,
    ValidateMessage
};