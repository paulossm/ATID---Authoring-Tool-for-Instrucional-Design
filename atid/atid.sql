--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.7
-- Dumped by pg_dump version 9.5.7

-- Started on 2017-07-14 13:33:30 BRT

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12395)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2244 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 181 (class 1259 OID 16541)
-- Name: arco; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE arco (
    id_arco integer NOT NULL,
    id_origem integer,
    id_destino integer
);


ALTER TABLE arco OWNER TO postgres;

--
-- TOC entry 182 (class 1259 OID 16544)
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
-- TOC entry 2245 (class 0 OID 0)
-- Dependencies: 182
-- Name: arco_id_arco_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE arco_id_arco_seq OWNED BY arco.id_arco;


--
-- TOC entry 183 (class 1259 OID 16546)
-- Name: atividade; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE atividade (
    id_atividade integer NOT NULL,
    nome character varying(255),
    posicao_x double precision,
    posicao_y double precision,
    id_rede integer
);


ALTER TABLE atividade OWNER TO postgres;

--
-- TOC entry 184 (class 1259 OID 16549)
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
-- TOC entry 2246 (class 0 OID 0)
-- Dependencies: 184
-- Name: atividade_id_atividade_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE atividade_id_atividade_seq OWNED BY atividade.id_atividade;


--
-- TOC entry 185 (class 1259 OID 16551)
-- Name: evento; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE evento (
    id_evento integer NOT NULL,
    posicao_x double precision,
    posicao_y double precision,
    id_rede integer
);


ALTER TABLE evento OWNER TO postgres;

--
-- TOC entry 186 (class 1259 OID 16554)
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
-- TOC entry 2247 (class 0 OID 0)
-- Dependencies: 186
-- Name: evento_id_evento_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evento_id_evento_seq OWNED BY evento.id_evento;


--
-- TOC entry 187 (class 1259 OID 16556)
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
-- TOC entry 188 (class 1259 OID 16559)
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
-- TOC entry 2248 (class 0 OID 0)
-- Dependencies: 188
-- Name: rede_id_rede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rede_id_rede_seq OWNED BY rede.id_rede;


--
-- TOC entry 198 (class 1259 OID 16751)
-- Name: redes_compartilhadas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE redes_compartilhadas (
    id_redes_compartilhadas integer NOT NULL,
    id_rede integer NOT NULL,
    id_usuario integer NOT NULL
);


ALTER TABLE redes_compartilhadas OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16749)
-- Name: redes_compartilhadas_id_redes_compartilhadas_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE redes_compartilhadas_id_redes_compartilhadas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE redes_compartilhadas_id_redes_compartilhadas_seq OWNER TO postgres;

--
-- TOC entry 2249 (class 0 OID 0)
-- Dependencies: 197
-- Name: redes_compartilhadas_id_redes_compartilhadas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE redes_compartilhadas_id_redes_compartilhadas_seq OWNED BY redes_compartilhadas.id_redes_compartilhadas;


--
-- TOC entry 189 (class 1259 OID 16561)
-- Name: repositorio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE repositorio (
    id_repositorio integer NOT NULL,
    posicao_x double precision,
    posicao_y double precision,
    id_rede integer
);


ALTER TABLE repositorio OWNER TO postgres;

--
-- TOC entry 190 (class 1259 OID 16564)
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
-- TOC entry 2250 (class 0 OID 0)
-- Dependencies: 190
-- Name: repositorio_id_repositorio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE repositorio_id_repositorio_seq OWNED BY repositorio.id_repositorio;


--
-- TOC entry 191 (class 1259 OID 16566)
-- Name: subrede; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE subrede (
    id_subrede integer NOT NULL,
    posicao_x double precision,
    posicao_y double precision,
    id_rede integer
);


ALTER TABLE subrede OWNER TO postgres;

--
-- TOC entry 192 (class 1259 OID 16569)
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
-- TOC entry 2251 (class 0 OID 0)
-- Dependencies: 192
-- Name: subrede_id_subrede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE subrede_id_subrede_seq OWNED BY subrede.id_subrede;


--
-- TOC entry 193 (class 1259 OID 16571)
-- Name: transicao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE transicao (
    id_transicao integer NOT NULL,
    posicao_x double precision,
    posicao_y double precision,
    id_rede integer
);


ALTER TABLE transicao OWNER TO postgres;

--
-- TOC entry 194 (class 1259 OID 16574)
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
-- TOC entry 2252 (class 0 OID 0)
-- Dependencies: 194
-- Name: transicao_id_transicao_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE transicao_id_transicao_seq OWNED BY transicao.id_transicao;


--
-- TOC entry 195 (class 1259 OID 16576)
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
-- TOC entry 196 (class 1259 OID 16583)
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
-- TOC entry 2253 (class 0 OID 0)
-- Dependencies: 196
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_usuario_seq OWNED BY usuario.id_usuario;


--
-- TOC entry 2068 (class 2604 OID 16585)
-- Name: id_arco; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY arco ALTER COLUMN id_arco SET DEFAULT nextval('arco_id_arco_seq'::regclass);


--
-- TOC entry 2069 (class 2604 OID 16586)
-- Name: id_atividade; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade ALTER COLUMN id_atividade SET DEFAULT nextval('atividade_id_atividade_seq'::regclass);


--
-- TOC entry 2070 (class 2604 OID 16587)
-- Name: id_evento; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento ALTER COLUMN id_evento SET DEFAULT nextval('evento_id_evento_seq'::regclass);


--
-- TOC entry 2071 (class 2604 OID 16588)
-- Name: id_rede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede ALTER COLUMN id_rede SET DEFAULT nextval('rede_id_rede_seq'::regclass);


--
-- TOC entry 2077 (class 2604 OID 16754)
-- Name: id_redes_compartilhadas; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY redes_compartilhadas ALTER COLUMN id_redes_compartilhadas SET DEFAULT nextval('redes_compartilhadas_id_redes_compartilhadas_seq'::regclass);


--
-- TOC entry 2072 (class 2604 OID 16589)
-- Name: id_repositorio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio ALTER COLUMN id_repositorio SET DEFAULT nextval('repositorio_id_repositorio_seq'::regclass);


--
-- TOC entry 2073 (class 2604 OID 16593)
-- Name: id_subrede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede ALTER COLUMN id_subrede SET DEFAULT nextval('subrede_id_subrede_seq'::regclass);


--
-- TOC entry 2074 (class 2604 OID 16594)
-- Name: id_transicao; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao ALTER COLUMN id_transicao SET DEFAULT nextval('transicao_id_transicao_seq'::regclass);


--
-- TOC entry 2076 (class 2604 OID 16595)
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id_usuario SET DEFAULT nextval('usuario_id_usuario_seq'::regclass);


--
-- TOC entry 2219 (class 0 OID 16541)
-- Dependencies: 181
-- Data for Name: arco; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY arco (id_arco, id_origem, id_destino) FROM stdin;
\.


--
-- TOC entry 2254 (class 0 OID 0)
-- Dependencies: 182
-- Name: arco_id_arco_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('arco_id_arco_seq', 1, false);


--
-- TOC entry 2221 (class 0 OID 16546)
-- Dependencies: 183
-- Data for Name: atividade; Type: TABLE DATA; Schema: public; Owner: postgres
--


--
-- TOC entry 2255 (class 0 OID 0)
-- Dependencies: 184
-- Name: atividade_id_atividade_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('atividade_id_atividade_seq', 41, true);


--
-- TOC entry 2223 (class 0 OID 16551)
-- Dependencies: 185
-- Data for Name: evento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY evento (id_evento, posicao_x, posicao_y, id_rede) FROM stdin;
1   594 200 34
\.


--
-- TOC entry 2256 (class 0 OID 0)
-- Dependencies: 186
-- Name: evento_id_evento_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evento_id_evento_seq', 1, true);


--
-- TOC entry 2225 (class 0 OID 16556)
-- Dependencies: 187
-- Data for Name: rede; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2257 (class 0 OID 0)
-- Dependencies: 188
-- Name: rede_id_rede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rede_id_rede_seq', 40, true);


--
-- TOC entry 2236 (class 0 OID 16751)
-- Dependencies: 198
-- Data for Name: redes_compartilhadas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2258 (class 0 OID 0)
-- Dependencies: 197
-- Name: redes_compartilhadas_id_redes_compartilhadas_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('redes_compartilhadas_id_redes_compartilhadas_seq', 3, true);


--
-- TOC entry 2227 (class 0 OID 16561)
-- Dependencies: 189
-- Data for Name: repositorio; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2259 (class 0 OID 0)
-- Dependencies: 190
-- Name: repositorio_id_repositorio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('repositorio_id_repositorio_seq', 1, true);


--
-- TOC entry 2229 (class 0 OID 16566)
-- Dependencies: 191
-- Data for Name: subrede; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2260 (class 0 OID 0)
-- Dependencies: 192
-- Name: subrede_id_subrede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('subrede_id_subrede_seq', 1, true);


--
-- TOC entry 2231 (class 0 OID 16571)
-- Dependencies: 193
-- Data for Name: transicao; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2261 (class 0 OID 0)
-- Dependencies: 194
-- Name: transicao_id_transicao_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('transicao_id_transicao_seq', 7, true);


--
-- TOC entry 2233 (class 0 OID 16576)
-- Dependencies: 195
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2262 (class 0 OID 0)
-- Dependencies: 196
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 2, true);


--
-- TOC entry 2079 (class 2606 OID 16597)
-- Name: id_arco; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY arco
    ADD CONSTRAINT id_arco PRIMARY KEY (id_arco);


--
-- TOC entry 2081 (class 2606 OID 16599)
-- Name: id_atividade; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade
    ADD CONSTRAINT id_atividade PRIMARY KEY (id_atividade);


--
-- TOC entry 2083 (class 2606 OID 16601)
-- Name: id_evento; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT id_evento PRIMARY KEY (id_evento);


--
-- TOC entry 2085 (class 2606 OID 16603)
-- Name: id_rede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_rede PRIMARY KEY (id_rede);


--
-- TOC entry 2095 (class 2606 OID 16756)
-- Name: id_redes_compartilhadas; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY redes_compartilhadas
    ADD CONSTRAINT id_redes_compartilhadas PRIMARY KEY (id_redes_compartilhadas);


--
-- TOC entry 2087 (class 2606 OID 16605)
-- Name: id_repositorio; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio
    ADD CONSTRAINT id_repositorio PRIMARY KEY (id_repositorio);


--
-- TOC entry 2089 (class 2606 OID 16607)
-- Name: id_subrede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede
    ADD CONSTRAINT id_subrede PRIMARY KEY (id_subrede);


--
-- TOC entry 2091 (class 2606 OID 16609)
-- Name: id_transicao; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao
    ADD CONSTRAINT id_transicao PRIMARY KEY (id_transicao);


--
-- TOC entry 2093 (class 2606 OID 16611)
-- Name: id_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT id_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 2098 (class 2606 OID 16612)
-- Name: id_criador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_criador FOREIGN KEY (id_criador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2099 (class 2606 OID 16617)
-- Name: id_modificador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_modificador FOREIGN KEY (id_modificador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2096 (class 2606 OID 16622)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY atividade
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2102 (class 2606 OID 16627)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY transicao
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2097 (class 2606 OID 16632)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evento
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2100 (class 2606 OID 16637)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY repositorio
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2101 (class 2606 OID 16642)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY subrede
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2103 (class 2606 OID 16757)
-- Name: id_rede; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY redes_compartilhadas
    ADD CONSTRAINT id_rede FOREIGN KEY (id_rede) REFERENCES rede(id_rede);


--
-- TOC entry 2104 (class 2606 OID 16762)
-- Name: id_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY redes_compartilhadas
    ADD CONSTRAINT id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario);


--
-- TOC entry 2243 (class 0 OID 0)
-- Dependencies: 7
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-07-14 13:33:31 BRT

--
-- PostgreSQL database dump complete
--

