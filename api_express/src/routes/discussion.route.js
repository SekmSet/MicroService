const express = require('express');
const {getDiscussion, getDiscussions, createDiscussion, addMessageToDiscussion, deleteMessageToDiscussion, deleteDiscussion} = require('../controllers/discussion.controller');
const router = express.Router();

router.get('', getDiscussions);
router.post('', createDiscussion);
router.post('/:id', addMessageToDiscussion);
router.get('/:id', getDiscussion);
router.delete('/:id_room/:id_message', deleteMessageToDiscussion);
router.delete('/:id_room', deleteDiscussion);

module.exports = router;