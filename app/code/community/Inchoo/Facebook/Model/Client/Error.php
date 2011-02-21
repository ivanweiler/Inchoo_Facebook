<?php
// Copyright 2004-2009 Facebook. All Rights Reserved.
//
// +---------------------------------------------------------------------------+
// | Facebook Platform PHP5 client                                             |
// +---------------------------------------------------------------------------+
// | Copyright (c) 2007-2009 Facebook, Inc.                                    |
// | All rights reserved.                                                      |
// |                                                                           |
// | Redistribution and use in source and binary forms, with or without        |
// | modification, are permitted provided that the following conditions        |
// | are met:                                                                  |
// |                                                                           |
// | 1. Redistributions of source code must retain the above copyright         |
// |    notice, this list of conditions and the following disclaimer.          |
// | 2. Redistributions in binary form must reproduce the above copyright      |
// |    notice, this list of conditions and the following disclaimer in the    |
// |    documentation and/or other materials provided with the distribution.   |
// |                                                                           |
// | THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR      |
// | IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES |
// | OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.   |
// | IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,          |
// | INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT  |
// | NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY     |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT       |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF  |
// | THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.         |
// +---------------------------------------------------------------------------+
// | For help with this library, contact developers-help@facebook.com          |
// +---------------------------------------------------------------------------+
//

/**
 * Facebook REST client errors
 *
 * @category   Inchoo
 * @package    Inchoo_Facebook
 * @author     Ivan Weiler, Inchoo <web@inchoo.net>
 */
class Inchoo_Facebook_Model_Client_Error
{
	const API_EC_SUCCESS = 0;

  /*
   * GENERAL ERRORS
   */
  const API_EC_UNKNOWN = 1;
  const API_EC_SERVICE = 2;
  const API_EC_METHOD = 3;
  const API_EC_TOO_MANY_CALLS = 4;
  const API_EC_BAD_IP = 5;
  const API_EC_HOST_API = 6;
  const API_EC_HOST_UP = 7;
  const API_EC_SECURE = 8;
  const API_EC_RATE = 9;
  const API_EC_PERMISSION_DENIED = 10;
  const API_EC_DEPRECATED = 11;
  const API_EC_VERSION = 12;
  const API_EC_INTERNAL_FQL_ERROR = 13;
  const API_EC_HOST_PUP = 14;
  const API_EC_SESSION_SECRET_NOT_ALLOWED = 15;
  const API_EC_HOST_READONLY = 16;

  /*
   * PARAMETER ERRORS
   */
  const API_EC_PARAM = 100;
  const API_EC_PARAM_API_KEY = 101;
  const API_EC_PARAM_SESSION_KEY = 102;
  const API_EC_PARAM_CALL_ID = 103;
  const API_EC_PARAM_SIGNATURE = 104;
  const API_EC_PARAM_TOO_MANY = 105;
  const API_EC_PARAM_USER_ID = 110;
  const API_EC_PARAM_USER_FIELD = 111;
  const API_EC_PARAM_SOCIAL_FIELD = 112;
  const API_EC_PARAM_EMAIL = 113;
  const API_EC_PARAM_USER_ID_LIST = 114;
  const API_EC_PARAM_FIELD_LIST = 115;
  const API_EC_PARAM_ALBUM_ID = 120;
  const API_EC_PARAM_PHOTO_ID = 121;
  const API_EC_PARAM_FEED_PRIORITY = 130;
  const API_EC_PARAM_CATEGORY = 140;
  const API_EC_PARAM_SUBCATEGORY = 141;
  const API_EC_PARAM_TITLE = 142;
  const API_EC_PARAM_DESCRIPTION = 143;
  const API_EC_PARAM_BAD_JSON = 144;
  const API_EC_PARAM_BAD_EID = 150;
  const API_EC_PARAM_UNKNOWN_CITY = 151;
  const API_EC_PARAM_BAD_PAGE_TYPE = 152;
  const API_EC_PARAM_BAD_LOCALE = 170;
  const API_EC_PARAM_BLOCKED_NOTIFICATION = 180;

  /*
   * USER PERMISSIONS ERRORS
   */
  const API_EC_PERMISSION = 200;
  const API_EC_PERMISSION_USER = 210;
  const API_EC_PERMISSION_NO_DEVELOPERS = 211;
  const API_EC_PERMISSION_OFFLINE_ACCESS = 212;
  const API_EC_PERMISSION_ALBUM = 220;
  const API_EC_PERMISSION_PHOTO = 221;
  const API_EC_PERMISSION_MESSAGE = 230;
  const API_EC_PERMISSION_OTHER_USER = 240;
  const API_EC_PERMISSION_STATUS_UPDATE = 250;
  const API_EC_PERMISSION_PHOTO_UPLOAD = 260;
  const API_EC_PERMISSION_VIDEO_UPLOAD = 261;
  const API_EC_PERMISSION_SMS = 270;
  const API_EC_PERMISSION_CREATE_LISTING = 280;
  const API_EC_PERMISSION_CREATE_NOTE = 281;
  const API_EC_PERMISSION_SHARE_ITEM = 282;
  const API_EC_PERMISSION_EVENT = 290;
  const API_EC_PERMISSION_LARGE_FBML_TEMPLATE = 291;
  const API_EC_PERMISSION_LIVEMESSAGE = 292;
  const API_EC_PERMISSION_CREATE_EVENT = 296;
  const API_EC_PERMISSION_RSVP_EVENT = 299;

  /*
   * DATA EDIT ERRORS
   */
  const API_EC_EDIT = 300;
  const API_EC_EDIT_USER_DATA = 310;
  const API_EC_EDIT_PHOTO = 320;
  const API_EC_EDIT_ALBUM_SIZE = 321;
  const API_EC_EDIT_PHOTO_TAG_SUBJECT = 322;
  const API_EC_EDIT_PHOTO_TAG_PHOTO = 323;
  const API_EC_EDIT_PHOTO_FILE = 324;
  const API_EC_EDIT_PHOTO_PENDING_LIMIT = 325;
  const API_EC_EDIT_PHOTO_TAG_LIMIT = 326;
  const API_EC_EDIT_ALBUM_REORDER_PHOTO_NOT_IN_ALBUM = 327;
  const API_EC_EDIT_ALBUM_REORDER_TOO_FEW_PHOTOS = 328;

  const API_EC_MALFORMED_MARKUP = 329;
  const API_EC_EDIT_MARKUP = 330;

  const API_EC_EDIT_FEED_TOO_MANY_USER_CALLS = 340;
  const API_EC_EDIT_FEED_TOO_MANY_USER_ACTION_CALLS = 341;
  const API_EC_EDIT_FEED_TITLE_LINK = 342;
  const API_EC_EDIT_FEED_TITLE_LENGTH = 343;
  const API_EC_EDIT_FEED_TITLE_NAME = 344;
  const API_EC_EDIT_FEED_TITLE_BLANK = 345;
  const API_EC_EDIT_FEED_BODY_LENGTH = 346;
  const API_EC_EDIT_FEED_PHOTO_SRC = 347;
  const API_EC_EDIT_FEED_PHOTO_LINK = 348;

  const API_EC_EDIT_VIDEO_SIZE = 350;
  const API_EC_EDIT_VIDEO_INVALID_FILE = 351;
  const API_EC_EDIT_VIDEO_INVALID_TYPE = 352;
  const API_EC_EDIT_VIDEO_FILE = 353;

  const API_EC_EDIT_FEED_TITLE_ARRAY = 360;
  const API_EC_EDIT_FEED_TITLE_PARAMS = 361;
  const API_EC_EDIT_FEED_BODY_ARRAY = 362;
  const API_EC_EDIT_FEED_BODY_PARAMS = 363;
  const API_EC_EDIT_FEED_PHOTO = 364;
  const API_EC_EDIT_FEED_TEMPLATE = 365;
  const API_EC_EDIT_FEED_TARGET = 366;
  const API_EC_EDIT_FEED_MARKUP = 367;

  /**
   * SESSION ERRORS
   */
  const API_EC_SESSION_TIMED_OUT = 450;
  const API_EC_SESSION_METHOD = 451;
  const API_EC_SESSION_INVALID = 452;
  const API_EC_SESSION_REQUIRED = 453;
  const API_EC_SESSION_REQUIRED_FOR_SECRET = 454;
  const API_EC_SESSION_CANNOT_USE_SESSION_SECRET = 455;


  /**
   * FQL ERRORS
   */
  const FQL_EC_UNKNOWN_ERROR = 600;
  const FQL_EC_PARSER = 601; // backwards compatibility
  const FQL_EC_PARSER_ERROR = 601;
  const FQL_EC_UNKNOWN_FIELD = 602;
  const FQL_EC_UNKNOWN_TABLE = 603;
  const FQL_EC_NOT_INDEXABLE = 604; // backwards compatibility
  const FQL_EC_NO_INDEX = 604;
  const FQL_EC_UNKNOWN_FUNCTION = 605;
  const FQL_EC_INVALID_PARAM = 606;
  const FQL_EC_INVALID_FIELD = 607;
  const FQL_EC_INVALID_SESSION = 608;
  const FQL_EC_UNSUPPORTED_APP_TYPE = 609;
  const FQL_EC_SESSION_SECRET_NOT_ALLOWED = 610;
  const FQL_EC_DEPRECATED_TABLE = 611;
  const FQL_EC_EXTENDED_PERMISSION = 612;
  const FQL_EC_RATE_LIMIT_EXCEEDED = 613;
  const FQL_EC_UNRESOLVED_DEPENDENCY = 614;
  const FQL_EC_INVALID_SEARCH = 615;
  const FQL_EC_CONTAINS_ERROR = 616;

  const API_EC_REF_SET_FAILED = 700;

  /**
   * DATA STORE API ERRORS
   */
  const API_EC_DATA_UNKNOWN_ERROR = 800;
  const API_EC_DATA_INVALID_OPERATION = 801;
  const API_EC_DATA_QUOTA_EXCEEDED = 802;
  const API_EC_DATA_OBJECT_NOT_FOUND = 803;
  const API_EC_DATA_OBJECT_ALREADY_EXISTS = 804;
  const API_EC_DATA_DATABASE_ERROR = 805;
  const API_EC_DATA_CREATE_TEMPLATE_ERROR = 806;
  const API_EC_DATA_TEMPLATE_EXISTS_ERROR = 807;
  const API_EC_DATA_TEMPLATE_HANDLE_TOO_LONG = 808;
  const API_EC_DATA_TEMPLATE_HANDLE_ALREADY_IN_USE = 809;
  const API_EC_DATA_TOO_MANY_TEMPLATE_BUNDLES = 810;
  const API_EC_DATA_MALFORMED_ACTION_LINK = 811;
  const API_EC_DATA_TEMPLATE_USES_RESERVED_TOKEN = 812;

  /*
   * APPLICATION INFO ERRORS
   */
  const API_EC_NO_SUCH_APP = 900;

  /*
   * BATCH ERRORS
   */
  const API_EC_BATCH_TOO_MANY_ITEMS = 950;
  const API_EC_BATCH_ALREADY_STARTED = 951;
  const API_EC_BATCH_NOT_STARTED = 952;
  const API_EC_BATCH_METHOD_NOT_ALLOWED_IN_BATCH_MODE = 953;

  /*
   * EVENT API ERRORS
   */
  const API_EC_EVENT_INVALID_TIME = 1000;
  const API_EC_EVENT_NAME_LOCKED  = 1001;

  /*
   * INFO BOX ERRORS
   */
  const API_EC_INFO_NO_INFORMATION = 1050;
  const API_EC_INFO_SET_FAILED = 1051;

  /*
   * LIVEMESSAGE API ERRORS
   */
  const API_EC_LIVEMESSAGE_SEND_FAILED = 1100;
  const API_EC_LIVEMESSAGE_EVENT_NAME_TOO_LONG = 1101;
  const API_EC_LIVEMESSAGE_MESSAGE_TOO_LONG = 1102;

  /*
   * PAYMENTS API ERRORS
   */
  const API_EC_PAYMENTS_UNKNOWN = 1150;
  const API_EC_PAYMENTS_APP_INVALID = 1151;
  const API_EC_PAYMENTS_DATABASE = 1152;
  const API_EC_PAYMENTS_PERMISSION_DENIED = 1153;
  const API_EC_PAYMENTS_APP_NO_RESPONSE = 1154;
  const API_EC_PAYMENTS_APP_ERROR_RESPONSE = 1155;
  const API_EC_PAYMENTS_INVALID_ORDER = 1156;
  const API_EC_PAYMENTS_INVALID_PARAM = 1157;
  const API_EC_PAYMENTS_INVALID_OPERATION = 1158;
  const API_EC_PAYMENTS_PAYMENT_FAILED = 1159;
  const API_EC_PAYMENTS_DISABLED = 1160;

  /*
   * CONNECT SESSION ERRORS
   */
  const API_EC_CONNECT_FEED_DISABLED = 1300;

  /*
   * Platform tag bundles errors
   */
  const API_EC_TAG_BUNDLE_QUOTA = 1400;

  /*
   * SHARE
   */
  const API_EC_SHARE_BAD_URL = 1500;

  /*
   * NOTES
   */
  const API_EC_NOTE_CANNOT_MODIFY = 1600;

  /*
   * COMMENTS
   */
  const API_EC_COMMENTS_UNKNOWN = 1700;
  const API_EC_COMMENTS_POST_TOO_LONG = 1701;
  const API_EC_COMMENTS_DB_DOWN = 1702;
  const API_EC_COMMENTS_INVALID_XID = 1703;
  const API_EC_COMMENTS_INVALID_UID = 1704;
  const API_EC_COMMENTS_INVALID_POST = 1705;
  const API_EC_COMMENTS_INVALID_REMOVE = 1706;

  /*
   * GIFTS
   */
  const API_EC_GIFTS_UNKNOWN = 1900;

  /*
   * APPLICATION MORATORIUM ERRORS
   */
  const API_EC_DISABLED_ALL = 2000;
  const API_EC_DISABLED_STATUS = 2001;
  const API_EC_DISABLED_FEED_STORIES = 2002;
  const API_EC_DISABLED_NOTIFICATIONS = 2003;
  const API_EC_DISABLED_REQUESTS = 2004;
  const API_EC_DISABLED_EMAIL = 2005;
  
}
