const { registerBlockType } = wp.blocks;
const { withSelect } = wp.data;
const { RichText, InspectorControls } = window.wp.blockEditor;
const {
  PanelBody,
  RangeControl,
  SelectControl,
  TextControl,
} = window.wp.components;

//Logo para el bloque
import { ReactComponent as Logo } from "../logo.svg";

registerBlockType("lapizzeria/menu", {
  title: "La Pizzeria Menu",
  icon: { src: Logo },
  category: "lapizzeria",
  attributes: {
    cantidadMostrar: {
      type: "number",
    },
    categoriaMenu: {
      type: "number",
    },
    tituloBloque: {
      type: "string",
    },
  },
  edit: withSelect((select, props) => {
    //Extraer los valores
    const {
      attributes: { cantidadMostrar, categoriaMenu, tituloBloque },
      setAttributes,
    } = props;
    const onChangeCantidadMostrar = (newCantidadMostrar) => {
      setAttributes({ cantidadMostrar: parseInt(newCantidadMostrar) });
    };
    const onChangeCategoriaMenu = (newCategoriaMenu) => {
      setAttributes({ categoriaMenu: newCategoriaMenu });
    };
    const onChangeTituloBloque = (newTituloBloque) => {
      setAttributes({ tituloBloque: newTituloBloque });
    };
    return {
      // Enviar una petición/consulta a la API para obtener los datos
      especialidades: select("core").getEntityRecords(
        "postType",
        "especialidades",
        { "categoria-menu": categoriaMenu, per_page: cantidadMostrar || 4 }
      ),
      categorias: select("core").getEntityRecords("taxonomy", "categoria-menu"),
      onChangeCantidadMostrar,
      onChangeCategoriaMenu,
      onChangeTituloBloque,
      props,
    };
  })(
    ({
      especialidades,
      categorias,
      onChangeCantidadMostrar,
      onChangeCategoriaMenu,
      onChangeTituloBloque,
      props,
    }) => {
      //Extraer los valores del atributo desde props
      const {
        attributes: { cantidadMostrar, categoriaMenu, tituloBloque },
      } = props;

      // Verificar especialidades
      if (!especialidades) {
        return "Cargando...";
      }

      // Si no hay especialidades
      if (especialidades && especialidades.length === 0) {
        return "No hay resultados";
      }

      // Verificar categorias
      if (!categorias) {
        return "No hay categorias";
      }

      // Si no hay categorias
      if (categorias && categorias.length === 0) {
        return "No hay resultados";
      }

      //Generar label y value para el select de categorias
      categorias.forEach((categoria) => {
        categoria["label"] = categoria.name;
        categoria["value"] = categoria.id;
      });

      //Arreglo con valores por defaulT
      const opcionDefault = [{ value: "", label: "-- Todos --" }];

      const listadoCategorias = [...opcionDefault, ...categorias];

      return (
        <>
          <InspectorControls>
            <PanelBody title={"Cantidad a Mostrar"} initalOpen={true}>
              <div className="components-base-control">
                <div className="components-base-control__field">
                  <label className="components-base-control__label">
                    Cantidad a Mostrar
                  </label>
                  <RangeControl
                    onChange={onChangeCantidadMostrar}
                    min={2}
                    max={10}
                    value={cantidadMostrar || 4}
                  />
                </div>
              </div>
            </PanelBody>

            <PanelBody title={"Categoría de Especialidad"} initalOpen={false}>
              <div className="components-base-control">
                <div className="components-base-control__field">
                  <label className="components-base-control__label">
                    Categoría de Especialidad
                  </label>
                  <SelectControl
                    options={listadoCategorias}
                    onChange={onChangeCategoriaMenu}
                    value={categoriaMenu}
                  />
                </div>
              </div>
            </PanelBody>

            <PanelBody title={"Titulo Bloque"} initalOpen={false}>
              <div className="components-base-control">
                <div className="components-base-control__field">
                  <label className="components-base-control__label">
                    Titulo Bloque
                  </label>
                  <TextControl
                    onChange={onChangeTituloBloque}
                    value={tituloBloque}
                  />
                </div>
              </div>
            </PanelBody>
          </InspectorControls>
          <h2 className="titulo-menu">{tituloBloque}</h2>
          <ul className="nuestro-menu">
            {especialidades.map((especialidad) => (
              <li>
                {" "}
                <img
                  src={especialidad.imagen_destacada}
                  alt="imagen destacada"
                />
                <div className="platillo">
                  <div className="precio-titulo">
                    <h3>{especialidad.title.rendered}</h3>{" "}
                    <p>$ {especialidad.precio}</p>
                  </div>
                  <div className="contenido-platillo">
                    <p>
                      <RichText.Content value={especialidad.content.rendered} />
                    </p>
                  </div>
                </div>
              </li>
            ))}
          </ul>
        </>
      );
    }
  ),
  save: () => {
    return null;
  },
});
