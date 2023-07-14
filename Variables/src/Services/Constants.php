<?php

namespace Jasontuan\FigmaImport\Services\Constants;

const PATTERN_PALETTE = '/(.*)\t(.*)?\t(--mud-.*)/';
const PATTERN_TYPOGRAPHY = '/(.*)\t(--mud-.*)/';
const PATTERN_SHADOWS = '/(.*)\t(--mud-.*)/';
const PATTERN_LAYOUT_PROPERTIES = '/(.*)\t(--mud-.*)/';
const PATTERN_ZINDEX = '/(.*)\t(--mud-.*)/';

const PATTERN_SIZE_VALUE = '/^[\d\.]+(em|px|rem|\%)$/';
const PATTERN_NUMBER_VALUE = '/^[\d\.]+$/';
const PATTERN_FONT_FAMILY = '/^(.*)\-family$/';
const PATTERN_TEXT_TRANSFORM= '/^(.*)\-transform$/';
const PATTERN_TEXT_WEIGHT= '/^(.*)\-weight$/';
const PATTERN_RGBA_VALUE = '/^(rgb|rgba)\(.*$/';
