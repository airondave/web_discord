--
-- SQLINES DEMO *** se dump
--

-- SQLINES DEMO *** ase version 17.5
-- SQLINES DEMO ***  version 17.5

-- SQLINES DEMO *** 8-09 20:22:28

/* SET statement_timeout = 0; */
/* SET lock_timeout = 0; */
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
/* SET client_encoding = 'UTF8'; */
/* SET standard_conforming_strings = on; */
-- SQLINES FOR EVALUATION USE ONLY (14 DAYS)
SELECT pg_catalog.set_config('search_path', '', false);
/* SET check_function_bodies = false; */
SET xmloption = content;
/* SET client_min_messages = warning; */
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- SQLINES DEMO *** ass 1259 OID 16493)
-- SQLINES DEMO *** e: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.admins (
    id bigint NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at datetime(0),
    updated_at datetime(0)
);


--
-- SQLINES DEMO *** ass 1259 OID 16492)
-- SQLINES DEMO *** eq; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.admins_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** eq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.admins_id_seq OWNED BY public.admins.id;


--
-- SQLINES DEMO *** ass 1259 OID 16419)
-- SQLINES DEMO *** : TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value longtext NOT NULL,
    expiration integer NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16426)
-- SQLINES DEMO *** ; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16451)
-- SQLINES DEMO *** ; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection longtext NOT NULL,
    queue longtext NOT NULL,
    payload longtext NOT NULL,
    exception longtext NOT NULL,
    failed_at datetime(0) DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16450)
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.failed_jobs_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- SQLINES DEMO *** ass 1259 OID 16443)
-- SQLINES DEMO *** ; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids longtext NOT NULL,
    options longtext,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- SQLINES DEMO *** ass 1259 OID 16434)
-- SQLINES DEMO ***  TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload longtext NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16433)
-- SQLINES DEMO *** ; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.jobs_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** ; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- SQLINES DEMO *** ass 1259 OID 16386)
-- SQLINES DEMO ***  Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16385)
-- SQLINES DEMO *** id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.migrations_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- SQLINES DEMO *** ass 1259 OID 16403)
-- SQLINES DEMO *** set_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at datetime(0)
);


--
-- SQLINES DEMO *** ass 1259 OID 16505)
-- SQLINES DEMO *** : TABLE; Schema: public; Owner: -
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description longtext,
    is_active boolean DEFAULT true NOT NULL,
    created_at datetime(0),
    updated_at datetime(0)
);


--
-- SQLINES DEMO *** ass 1259 OID 16504)
-- SQLINES DEMO *** q; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.roles_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** q; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- SQLINES DEMO *** ass 1259 OID 16410)
-- SQLINES DEMO *** ype: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent longtext,
    payload longtext NOT NULL,
    last_activity integer NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16463)
-- SQLINES DEMO *** ; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.submissions (
    id bigint NOT NULL,
    discord_username character varying(255) NOT NULL,
    proof_url character varying(255) NOT NULL,
    status character varying(255) DEFAULT 'pending'::character varying(1) NOT NULL,
    created_at datetime(0),
    updated_at datetime(0),
    discord_id character varying(255) NOT NULL,
    CONSTRAINT submissions_status_check CHECK (((status)::longtext = ANY ((ARRAY['pending'::character varying, 'approved'::character varying, 'rejected'::character varying])::text[])))
);


--
-- SQLINES DEMO *** ass 1259 OID 16462)
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.submissions_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.submissions_id_seq OWNED BY public.submissions.id;


--
-- SQLINES DEMO *** ass 1259 OID 16478)
-- SQLINES DEMO *** gg; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.submissionsgg (
    id bigint NOT NULL,
    discord_id character varying(1) NOT NULL,
    discord_username character varying(1) NOT NULL,
    proof_path character varying(255),
    review_note longtext,
    reviewed_by bigint,
    status character varying(1) DEFAULT 'pending'::character varying(1) NOT NULL,
    created_at datetime DEFAULT now() NOT NULL,
    updated_at datetime DEFAULT now() NOT NULL,
    proof_url character varying(255),
    role_id bigint,
    desired_role character varying(255),
    submission_type character varying(255) DEFAULT 'regular'::character varying(1) NOT NULL
);


--
-- SQLINES DEMO *** ass 1259 OID 16477)
-- SQLINES DEMO *** gg_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.submissionsgg_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** gg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.submissionsgg_id_seq OWNED BY public.submissionsgg.id;


--
-- SQLINES DEMO *** ass 1259 OID 16393)
-- SQLINES DEMO *** : TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at datetime(0),
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at datetime(0),
    updated_at datetime(0)
);


--
-- SQLINES DEMO *** ass 1259 OID 16392)
-- SQLINES DEMO *** q; Type: SEQUENCE; Schema: public; Owner: -
--

CALL CreateSequence('public.users_id_seq', 1, 1)
    NO 1;


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** q; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- SQLINES DEMO *** lass 2604 OID 16496)
-- SQLINES DEMO *** Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admins ALTER COLUMN id SET DEFAULT nextval('public.admins_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16454)
-- SQLINES DEMO ***  id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16437)
-- SQLINES DEMO *** pe: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16389)
-- SQLINES DEMO *** id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16508)
-- SQLINES DEMO *** ype: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16466)
-- SQLINES DEMO ***  id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submissions ALTER COLUMN id SET DEFAULT nextval('public.submissions_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16481)
-- SQLINES DEMO *** gg id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submissionsgg ALTER COLUMN id SET DEFAULT nextval('public.submissionsgg_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 2604 OID 16396)
-- SQLINES DEMO *** ype: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- SQLINES DEMO *** lass 0 OID 16493)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** mins; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.admins VALUES (3, 'venla', '$2y$12$44wZae.pdKfK8fDdwVytfeL3mG2Jy.yQLnFbS0Ncd.WvwmMU/3IIe', 'venlarc', true, '2025-08-09 09:09:39', '2025-08-09 09:09:39');
INSERT INTO public.admins VALUES (4, 'jabet', '$2y$12$asjv.t0QuzP.l4.J9USU0.CulhzNXsmiEGRoqGTq52qdkYAPHGXqu', 'jabetrc', true, '2025-08-09 09:10:15', '2025-08-09 09:10:15');


--
-- SQLINES DEMO *** lass 0 OID 16419)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** che; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16426)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** che_locks; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16451)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** iled_jobs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16443)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** b_batches; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16434)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** bs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16386)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** grations; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.migrations VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO public.migrations VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO public.migrations VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO public.migrations VALUES (4, '2025_08_09_055129_create_submissions_table', 2);
INSERT INTO public.migrations VALUES (5, '2025_08_09_062854_add_discord_id_to_submissions_table', 3);
INSERT INTO public.migrations VALUES (6, '2025_08_09_064040_add_missing_columns_to_submissionsgg_table', 4);
INSERT INTO public.migrations VALUES (7, '2025_08_09_064908_create_admins_table', 5);
INSERT INTO public.migrations VALUES (8, '2025_08_09_070259_create_roles_table', 6);
INSERT INTO public.migrations VALUES (9, '2025_08_09_070335_add_role_id_to_submissionsgg_table', 6);
INSERT INTO public.migrations VALUES (10, '2025_08_09_082105_add_desired_role_to_submissionsgg_table', 7);
INSERT INTO public.migrations VALUES (11, '2025_08_09_085642_add_submission_type_to_submissionsgg_table', 8);
INSERT INTO public.migrations VALUES (12, '2025_08_09_090555_make_proof_path_nullable_in_submissionsgg_table', 9);


--
-- SQLINES DEMO *** lass 0 OID 16403)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** ssword_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 16505)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** les; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.roles VALUES (1, 'Tarnished', 'Entry-level role for new members', true, '2025-08-09 07:05:43', '2025-08-09 07:05:43');
INSERT INTO public.roles VALUES (2, 'RC Supremacy', 'Advanced role for experienced members', true, '2025-08-09 07:05:43', '2025-08-09 07:05:43');
INSERT INTO public.roles VALUES (3, 'Tempest', 'Elite role with special privileges', true, '2025-08-09 07:05:43', '2025-08-09 07:05:43');
INSERT INTO public.roles VALUES (4, 'Postmortal', 'High-tier role for veteran members', true, '2025-08-09 07:05:43', '2025-08-09 07:05:43');
INSERT INTO public.roles VALUES (5, 'Razorvine', 'Exclusive role for top contributors', true, '2025-08-09 07:05:43', '2025-08-09 07:05:43');
INSERT INTO public.roles VALUES (6, 'Peers', 'Leadership role for community peers', true, '2025-08-09 07:05:43', '2025-08-09 07:13:48');


--
-- SQLINES DEMO *** lass 0 OID 16410)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** ssions; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.sessions VALUES ('VFJ9qDiZ7DyAseySM0gXgZr18pSIapL1qwYLsxwu', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRmZYeXZuTEJsRnVscHl0S0h4Z0s2VDJTMHAyUmtORnBSUGF5cjNpOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zdWJtaXNzaW9ucyI7fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjEyOiJkaXNjb3JkX3VzZXIiO2E6NDp7czoyOiJpZCI7czoxODoiNzUwOTg5ODM2MjA2MzQyMTg1IjtzOjg6InVzZXJuYW1lIjtzOjE4OiJ0aGlzaXN3aGVyZXlvdWxvc3MiO3M6MTM6ImRpc2NyaW1pbmF0b3IiO3M6MToiMCI7czo2OiJhdmF0YXIiO3M6OTA6Imh0dHBzOi8vY2RuLmRpc2NvcmRhcHAuY29tL2F2YXRhcnMvNzUwOTg5ODM2MjA2MzQyMTg1LzFmZWI2ODdlZDIxMjc5ZGM4ZTI1ZjBmMzhhM2EwYzA1LmpwZyI7fX0=', 1754741920);


--
-- SQLINES DEMO *** lass 0 OID 16463)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** bmissions; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.submissions VALUES (1, 'sigma#123', 'uploads/1754721342.jpg', 'pending', '2025-08-09 06:35:42', '2025-08-09 06:35:42', 'sigma');


--
-- SQLINES DEMO *** lass 0 OID 16478)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** bmissionsgg; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.submissionsgg VALUES (11, '750989836206342185', 'thisiswhereyouloss', 'uploads/1754730486.jpg', NULL, NULL, 'approved', '2025-08-09 09:08:06+07', '2025-08-09 09:08:55+07', NULL, 6, NULL, 'butun');
INSERT INTO public.submissionsgg VALUES (10, '750989836206342185', 'thisiswhereyouloss', NULL, NULL, NULL, 'approved', '2025-08-09 09:07:37+07', '2025-08-09 09:08:57+07', NULL, 4, 'TAXXER', 'regular');
INSERT INTO public.submissionsgg VALUES (13, '750989836206342185', 'thisiswhereyouloss', 'uploads/1754738527.jpg', NULL, NULL, 'rejected', '2025-08-09 11:22:07+07', '2025-08-09 11:22:17+07', NULL, 6, NULL, 'butun');
INSERT INTO public.submissionsgg VALUES (12, '7509898362063421855555555555555555555555', 'sigma gaming', NULL, NULL, NULL, 'rejected', '2025-08-09 11:20:34+07', '2025-08-09 11:22:19+07', NULL, 6, 'sigma', 'regular');
INSERT INTO public.submissionsgg VALUES (14, '750989836206342185', 'thisiswhereyouloss', NULL, NULL, NULL, 'pending', '2025-08-09 12:17:30+07', '2025-08-09 12:17:30+07', NULL, 6, 'MOGMAXXER', 'regular');


--
-- SQLINES DEMO *** lass 0 OID 16393)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** ers; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** eq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.admins_id_seq', 4, true);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** ; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 12, true);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** q; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.roles_id_seq', 7, true);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** _id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.submissions_id_seq', 1, true);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** gg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.submissionsgg_id_seq', 14, true);


--
-- SQLINES DEMO *** lass 0 OID 0)
-- De... SQLINES DEMO ***
-- SQLINES DEMO *** q; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, false);


--
-- SQLINES DEMO *** lass 2606 OID 16501)
-- SQLINES DEMO *** ns_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16503)
-- SQLINES DEMO *** ns_username_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.admins
    ADD CONSTRAINT admins_username_unique UNIQUE (username);


--
-- SQLINES DEMO *** lass 2606 OID 16432)
-- SQLINES DEMO ***  cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY(key);


--
-- SQLINES DEMO *** lass 2606 OID 16425)
-- SQLINES DEMO *** _pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY(key);


--
-- SQLINES DEMO *** lass 2606 OID 16459)
-- SQLINES DEMO ***  failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16461)
-- SQLINES DEMO ***  failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- SQLINES DEMO *** lass 2606 OID 16449)
-- SQLINES DEMO ***  job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16441)
-- SQLINES DEMO *** key; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16391)
-- SQLINES DEMO *** migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16409)
-- SQLINES DEMO *** set_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY(email);


--
-- SQLINES DEMO *** lass 2606 OID 16515)
-- SQLINES DEMO *** _name_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_unique UNIQUE (name);


--
-- SQLINES DEMO *** lass 2606 OID 16513)
-- SQLINES DEMO *** _pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16416)
-- SQLINES DEMO *** ssions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16488)
-- SQLINES DEMO *** gg submissions_pk; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submissionsgg
    ADD CONSTRAINT submissions_pk PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16472)
-- SQLINES DEMO ***  submissions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submissions
    ADD CONSTRAINT submissions_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 2606 OID 16402)
-- SQLINES DEMO *** _email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- SQLINES DEMO *** lass 2606 OID 16400)
-- SQLINES DEMO *** _pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY(id);


--
-- SQLINES DEMO *** lass 1259 OID 16442)
-- SQLINES DEMO *** index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree(queue);


--
-- SQLINES DEMO *** lass 1259 OID 16418)
-- SQLINES DEMO *** st_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree(last_activity);


--
-- SQLINES DEMO *** lass 1259 OID 16417)
-- SQLINES DEMO *** er_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree(user_id);


--
-- SQLINES DEMO *** lass 2606 OID 16516)
-- SQLINES DEMO *** gg submissionsgg_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.submissionsgg
    ADD CONSTRAINT submissionsgg_role_id_foreign FOREIGN KEY(role_id) REFERENCES public.roles(id) ON DELETE SET NULL;


-- SQLINES DEMO *** -08-09 20:22:29

--
-- SQLINES DEMO *** se dump complete
--

