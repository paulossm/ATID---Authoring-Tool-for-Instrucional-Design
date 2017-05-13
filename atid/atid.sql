--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

-- Started on 2017-05-13 16:20:55 BRT

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
-- TOC entry 2162 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

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
-- TOC entry 2163 (class 0 OID 0)
-- Dependencies: 183
-- Name: rede_id_rede_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE rede_id_rede_seq OWNED BY rede.id_rede;


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
-- TOC entry 2164 (class 0 OID 0)
-- Dependencies: 181
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_usuario_seq OWNED BY usuario.id_usuario;


--
-- TOC entry 2030 (class 2604 OID 16411)
-- Name: id_rede; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede ALTER COLUMN id_rede SET DEFAULT nextval('rede_id_rede_seq'::regclass);


--
-- TOC entry 2028 (class 2604 OID 16399)
-- Name: id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id_usuario SET DEFAULT nextval('usuario_id_usuario_seq'::regclass);


--
-- TOC entry 2154 (class 0 OID 16408)
-- Dependencies: 184
-- Data for Name: rede; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rede (id_rede, data_criacao, data_modificacao, id_criador, id_modificador, nome) FROM stdin;
1	2017-05-13 16:45:01	2017-05-13 16:45:01	1	1	Rede de teste
2	2017-05-13 18:35:01	2017-05-13 18:35:01	1	1	Rede 2
\.


--
-- TOC entry 2165 (class 0 OID 0)
-- Dependencies: 183
-- Name: rede_id_rede_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('rede_id_rede_seq', 2, true);


--
-- TOC entry 2152 (class 0 OID 16396)
-- Dependencies: 182
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (id_usuario, nome, email, senha, ativo) FROM stdin;
1	Débora Emili Costa Oliveira	debaemili@gmail.com	202cb962ac59075b964b07152d234b70	t
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
-- TOC entry 2166 (class 0 OID 0)
-- Dependencies: 181
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_usuario_seq', 11, true);


--
-- TOC entry 2034 (class 2606 OID 16413)
-- Name: id_rede; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_rede PRIMARY KEY (id_rede);


--
-- TOC entry 2032 (class 2606 OID 16405)
-- Name: id_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT id_usuario PRIMARY KEY (id_usuario);


--
-- TOC entry 2035 (class 2606 OID 16414)
-- Name: id_criador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_criador FOREIGN KEY (id_criador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2036 (class 2606 OID 16419)
-- Name: id_modificador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY rede
    ADD CONSTRAINT id_modificador FOREIGN KEY (id_modificador) REFERENCES usuario(id_usuario);


--
-- TOC entry 2161 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2017-05-13 16:20:55 BRT

--
-- PostgreSQL database dump complete
--

