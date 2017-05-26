--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

-- Started on 2017-05-26 08:53:38 BRT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12397)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2233 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 194 (class 1259 OID 16521)
-- Name: arco; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE arco (
    id_arco integer NOT NULL,
    id_origem integer,
    id_destino integer
);


ALTER TABLE arco OWNER TO postgres;

--
-- TOC entry 193 (class 1259 OID 16519)
-- Name: arco_id_arco_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE arco_id_arco_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE arco_id_arco_seq OWNER TO postgres;

--
-- TOC entry 2234 (class 0 OID 0)
-- Dependencies: 193
-- Name: arco_id_arco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE arco_id_arco_seq OWNED BY arco.id_arco;


--
-- TOC entry 186 (class 1259 OID 16469)
-- Name: atividade; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE atividade (
    id_atividade integer NOT NULL,
    nome character varying(255),
    posicao_x integer,
    posicao_y integer,
    id_rede integer
);


ALTER TABLE atividade OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 16467)
-- Name: atividade_id_atividade_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE atividade_id_atividade_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE atividade_id_atividade_seq OWNER TO postgres;

--
-- TOC entry 2235 (class 0 OID 0)
-- Dependencies: 185
-- Name: atividade_id_atividade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE atividade_id_atividade_seq OWNED BY atividade.id_atividade;


--
-- TOC entry 190 (class 1259 OID 16495)
-- Name: evento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE evento (
    id_evento integer NOT NULL,
    posicao_x integer,
    posicao_y integer,
    id_rede integer
);


ALTER TABLE evento OWNER TO postgres;

--
-- TOC entry 189 (class 1259 OID 16493)
-- Name: evento_id_evento_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evento_id_evento_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE evento_id_evento_seq OWNER TO postgres;

--
-- TOC entry 2236 (class 0 OID 0)
-- Dependencies: 189
-- Name: evento_id_evento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_id_evento_seq OWNED BY evento.id_evento;


--
-- TOC entry 184 (class 1259 OID 16408)
-- Name: rede; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE rede (
    id_rede integer NOT NULL,
    data_criacao timestamp without time zone NOT NULL,
    data_modificacao timestamp without time zone NOT NULL,
    id_criador integer NOT NULL,
    id_modificador integer NOT NULL,
    nome character varying(255)
);


ALTER TABLE rede OWNER TO postgres;

--
-- TOC entry 183 (class 1259 OID 16406)
-- Name: rede_id_rede_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE rede_id_rede_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE rede_id_rede_seq OWNER TO postgres;

--
-- TOC entry 2237 (class 0 OID 0)
-- Dependencies: 183
-- Name: rede_id_rede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rede_id_rede_seq OWNED BY rede.id_rede;


--
-- TOC entry 192 (class 1259 OID 16508)
-- Name: repositorio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE repositorio (
    id_repositorio integer NOT NULL,
    posicao_x integer,
    posicao_y integer,
    id_rede integer
);


ALTER TABLE repositorio OWNER TO postgres;

--
-- TOC entry 191 (class 1259 OID 16506)
-- Name: repositorio_id_repositorio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE repositorio_id_repositorio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE repositorio_id_repositorio_seq OWNER TO postgres;

--
-- TOC entry 2238 (class 0 OID 0)
-- Dependencies: 191
-- Name: repositorio_id_repositorio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE repositorio_id_repositorio_seq OWNED BY repositorio.id_repositorio;


--
-- TOC entry 196 (class 1259 OID 16530)
-- Name: subrede; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subrede (
    id_subrede integer NOT NULL,
    posicao_x integer,
    posicao_y integer,
    id_rede integer
);


ALTER TABLE subrede OWNER TO postgres;

--
-- TOC entry 195 (class 1259 OID 16528)
-- Name: subrede_id_subrede_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE subrede_id_subrede_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE subrede_id_subrede_seq OWNER TO postgres;

--
-- TOC entry 2239 (class 0 OID 0)
-- Dependencies: 195
-- Name: subrede_id_subrede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subrede_id_subrede_seq OWNED BY subrede.id_subrede;


--
-- TOC entry 188 (class 1259 OID 16482)
-- Name: transicao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE transicao (
    id_transicao integer NOT NULL,
    posicao_x integer,
    posicao_y integer,
    id_rede integer
);


ALTER TABLE transicao OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 16480)
-- Name: transicao_id_transicao_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE transicao_id_transicao_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE transicao_id_transicao_seq OWNER TO postgres;

--
-- TOC entry 2240 (class 0 OID 0)
-- Dependencies: 187
-- Name: transicao_id_transicao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transicao_id_transicao_seq OWNED BY transicao.id_transicao;


--
-- TOC entry 182 (class 1259 OID 16396)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuario (
    id_usuario integer NOT NULL,
    nome character varying(255) NOT NULL,
    email character varying(255),
    senha character varying(255),
    ativo boolean DEFAULT true NOT NULL
);


ALTER TABLE usuario OWNER TO postgres;

--
-- TOC entry 181 (class 1259 OID 16394)
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_id_usuario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuario_id_usuario_seq OWNER TO postgres;

--
-- TOC entry 2241 (class 0 OID 0)
-- Dependencies: 181
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_usuario_seq OWNED BY usuario.id_usuario;


--
-- TOC entry 2071 (class 2604 OID 16524)
-- Name: id_arco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY arco ALTER COLUMN id_arco SET DEFAULT nextval('arco_id_arco_seq'::regclass);


--
-- TOC entry 2067 (class 2604 OID 16472)
-- Name: id_atividade; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade ALTER COLUMN id_atividade SET DEFAULT nextval('atividade_id_atividade_seq'::regclass);


--
-- TOC entry 2069 (class 2604 OID 16498)
-- Name: id_evento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento ALTER COLUMN id_evento SET DEFAULT nextval('evento_id_evento_seq'::regclass);


--
-- TOC entry 2066 (class 2604 OID 16411)
-- Name: id_rede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede ALTER COLUMN id_rede SET DEFAULT nextval('rede_id_rede_seq'::regclass);


--
-- TOC entry 2070 (class 2604 OID 16511)
-- Name: id_repositorio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio ALTER COLUMN id_repositorio SET DEFAULT nextval('repositorio_id_repositorio_seq'::regclass);


--
-- TOC entry 2072 (class 2604 OID 16533)
-- Name: id_subrede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede ALTER COLUMN id_subrede SET DEFAULT nextval('subrede_id_subrede_seq'::regclass);


--
-- TOC entry 2068 (class 2604 OID 16485)
-- Name: id_transicao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao ALTER COLUMN id_transicao SET DEFAULT nextval('transicao_id_transicao_seq'::regclass);


--
-- TOC entry 2064 (class 2604 OID 16399)
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id_usuario SET DEFAULT nextval('usuario_id_usuario_seq'::regclass);


--
-- TOC entry 2223 (class 0 OID 16521)
-- Dependencies: 194
-- Data for Name: arco; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY arco (id_arco, id_origem, id_destino) FROM stdin;
\.


--
-- TOC entry 2242 (class 0 OID 0)
-- Dependencies: 193
-- Name: arco_id_arco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('arco_id_arco_seq', 1, false);


--
-- TOC entry 2215 (class 0 OID 16469)
-- Dependencies: 186
-- Data for Name: atividade; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY atividade (id_atividade, nome, posicao_x, posicao_y, id_rede) FROM stdin;
\.


--
-- TOC entry 2243 (class 0 OID 0)
-- Dependencies: 185
-- Name: atividade_id_atividade_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('atividade_id_atividade_seq', 1, false);


--
-- TOC entry 2219 (class 0 OID 16495)
-- Dependencies: 190
-- Data for Name: evento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento (id_evento, posicao_x, posicao_y, id_rede) FROM stdin;
\.


--
-- TOC entry 2244 (class 0 OID 0)
-- Dependencies: 189
-- Name: evento_id_evento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_id_evento_seq', 1, false);


--
-- TOC entry 2213 (class 0 OID 16408)
-- Dependencies: 184
-- Data for Name: rede; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rede (id_rede, data_criacao, data_modificacao, id_criador, id_modificador, nome) FROM stdin;
1	2017-05-13 16:45:01	2017-05-13 16:45:01	1	1	Rede de teste
2	2017-05-13 18:35:01	2017-05-13 18:35:01	1	1	Rede 2
\.


--
-- TOC entry 2245 (class 0 OID 0)
-- Dependencies: 183
-- Name: rede_id_rede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rede_id_rede_seq', 2, true);


--
-- TOC entry 2221 (class 0 OID 16508)
-- Dependencies: 192
-- Data for Name: repositorio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY repositorio (id_repositorio, posicao_x, posicao_y, id_rede) FROM stdin;
\.


--
-- TOC entry 2246 (class 0 OID 0)
-- Dependencies: 191
-- Name: repositorio_id_repositorio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('repositorio_id_repositorio_seq', 1, false);


--
-- TOC entry 2225 (class 0 OID 16530)
-- Dependencies: 196
-- Data for Name: subrede; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY subrede (id_subrede, posicao_x, posicao_y, id_rede) FROM stdin;
\.


--
-- TOC entry 2247 (class 0 OID 0)
-- Dependencies: 195
-- Name: subrede_id_subrede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subrede_id_subrede_seq', 1, false);


--
-- TOC entry 2217 (class 0 OID 16482)
-- Dependencies: 188
-- Data for Name: transicao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY transicao (id_transicao, posicao_x, posicao_y, id_rede) FROM stdin;
\.


--
-- TOC entry 2248 (class 0 OID 0)
-- Dependencies: 187
-- Name: transicao_id_transicao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transicao_id_transicao_seq', 1, false);


--
-- TOC entry 2211 (class 0 OID 16396)
-- Dependencies: 182
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (id_usuario, nome, email, senha, ativo) FROM stdin;
12	Bel Dillmann	bel@imd.ufrn.br	202cb962ac59075b964b07152d234b70	t
1	Débora Emili Costa Oliveira	debaemili@gmail.com	202cb962ac59075b964b07152d234b70	t
13	thayrone	thay@hotmail.com	202cb962ac59075b964b07152d234b70	t
2	teste 123	teste@email.com	81dc9bdb52d04dc20036dbd8313ed055	t
3	Teste da silva	teste1@email.com	81dc9bdb52d04dc20036dbd8313ed055	t
4	paulo	paulo@gmail.com	202cb962ac59075b964b07152d234b70	t
5	paulo	paulo1@gmail.com	74b87337454200d4d33f80c4663dc5e5	t
6	renno	renno@gmail.com	202cb962ac59075b964b07152d234b70	t
7	renno	renno@gmail.com.br	b2ca678b4c936f905fb82f2733f5297f	t
8	teste 123	teste1@email.com.vr	9f6e6800cfae7749eb6c486619254b9c	t
9	ariel	ariel@gmail.com	50941bf460efcb1356249a2e5018f8c8	t
10	leticia	leticia@gmail.com	202cb962ac59075b964b07152d234b70	t
11	Renno Frank de Melo Xavier	rennosmx@hotmail.com	202cb962ac59075b964b07152d234b70	t
\.


--
-- TOC entry 2249 (class 0 OID 0)
-- Dependencies: 181
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 13, true);


--
-- TOC entry 2086 (class 2606 OID 16526)
-- Name: id_arco; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY arco
    ADD CONSTRAINT id_arco PRIMARY KEY (id_arco);


--
-- TOC entry 2078 (class 2606 OID 16474)
-- Name: id_atividade; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade
    ADD CONSTRAINT id_atividade PRIMARY KEY (id_atividade);


--
-- TOC entry 2082 (class 2606 OID 16500)
-- Name: id_evento; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT id_evento PRIMARY KEY (id_evento);


--
-- TOC entry 2076 (class 2606 OID 16413)
-- Name: id_rede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_rede PRIMARY KEY (id_rede);


--
-- TOC entry 2084 (class 2606 OID 16513)
-- Name: id_repositorio; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio
    ADD CONSTRAINT id_repositorio PRIMARY KEY (id_repositorio);


--
-- TOC entry 2088 (class 2606 OID 16535)
-- Name: id_subrede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede
    ADD CONSTRAINT id_subrede PRIMARY KEY (id_subrede);


--
-- TOC entry 2080 (class 2606 OID 16487)
-- Name: id_transicao; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao
    ADD CONSTRAINT id_transicao PRIMARY KEY (id_transicao);


--
-- TOC entry 2074 (class 2606 OID 16405)
-- Name: id_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT id_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 2089 (class 2606 OID 16414)
-- Name: id_criador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_criador FOREIGN KEY (id_criador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2090 (class 2606 OID 16419)
-- Name: id_modificador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_modificador FOREIGN KEY (id_modificador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2091 (class 2606 OID 16475)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2092 (class 2606 OID 16488)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2093 (class 2606 OID 16501)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2094 (class 2606 OID 16514)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2095 (class 2606 OID 16536)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2232 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-05-26 08:53:39 BRT

--
-- PostgreSQL database dump complete
--

